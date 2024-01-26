/// AllToScan ATS Class
const ATS = {
    /// ========== CONSTANTS ==========
    /// @constant {string[]}
    resultPageClasses: [
        "allToScanResult_block",
        "allToScanResult_tx",
        "allToScanResult_address",
        "allToScanResult_domain",
    ],
    /// @constant {string}
    siteUrl: SITE_URL,
    /// @constant {number}
    charLimit: 12,
    /// @constant {string}
    sitePath: SITE_PATH,
    /// @constant {string}
    apiUrl: "https://localhost.com/", //node.js url
    snsSuggestionsUrl: "https://sns-suggest-proxy.bonfida.com",

    /// @constan {object[]}
    blockchainToCoin: {
        eth: "ETH",
        bsc: "BNB",
        fantom: "FTM",
        polygon: "MATIC",
        syscoin: "SYS",
        arbitrum: "ETH",
        avalanche: "AVAX",
        optimism: "OP",
        wan: "WAN",
    },

    availablePlatforms: [
        "ethereum",
        "fantom",
        "binance-smart-chain",
        "avalanche",
        "polygon-pos",
        "arbitrum-one",
        "syscoin",
        "optimistic-etherum",
        "wanchain",
    ],

    /// ========== UI METHODS ==========

    /// @method {ui}
    suggestSNSDomainName: async (q) => {
        const suggestions = await fetch(ATS.snsSuggestionsUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ q }),
        });

        const suggestionsResp = await suggestions.json();

        console.log(suggestionsResp);

        return suggestionsResp;
    },

    /// @method {ui}
    search: async () => {
        const searchTerm = $("#searchInput").val();
        if (searchTerm.length === 0) {
        } else {
            const searchType = await ATS.determineSearchType(searchTerm);
            //console.log(searchType);
            if (searchType === "domain") {
                if(searchTerm.includes('.sol')){
                    window.location.href = `/domainSearch/${searchTerm}`;
                }
                // query domain.. {searchTerm}
                /// domain search from home page and header search inputs
                /// to enable this feature enable next line 👇🏻
                // window.location.href = `/domainSearch/${searchTerm}`;
            } else if (searchType === "tx") {
                const redirectUrl = `${ATS.siteUrl}${ATS.sitePath}transactions/${searchTerm}`;
                window.location.href = redirectUrl;
            } else if (searchType === "token") {
                const redirectUrl = `${ATS.siteUrl}${
                    ATS.sitePath
                }token/${searchTerm.replace(/ /g, "--")}`;
                window.location.href = redirectUrl;
            } else {
                const redirectUrl = `${ATS.siteUrl}${ATS.sitePath}${searchType}/${searchTerm}`;
                window.location.href = redirectUrl;
            }
        }
    },

    /// @method {ui}
    nextPage: async (btn) => {
        const { type, address, token } = btn.dataset;
        if (type === "txList") {
            const endpoint = `txList/${address}/${token}`;
            const query = await fetch(`${ATS.apiUrl}${endpoint}`);
            const { result } = await query.json();
            //console.log(result.nextPageToken);
            btn.dataset.token = result.nextPageToken;
            if (result) {
                ATS.applyDataToTransactionsTable(
                    result?.is_wan_included
                        ? result?.transactions[0]
                        : result?.transactions
                );
            }
        }
    },

    createBlockies: (searchTerm) => {
        var squareIcon = document.getElementById("squareIcon");
        var squareIconMobile = document.getElementById("squareIconMobile");
        squareIcon.style.backgroundImage =
            "url(" +
            blockies
                .create({ seed: searchTerm, size: 8, scale: 16 })
                .toDataURL() +
            ")";
        squareIconMobile.style.backgroundImage =
            "url(" +
            blockies
                .create({ seed: searchTerm, size: 8, scale: 16 })
                .toDataURL() +
            ")";
    },

    /// @method {ui}
    ///         applies the wallet info data
    ///         to the ui
    applyData: async (data) => {
        const searchTerm = ATS.getSearchTermFromUrl();
        const searchType = await ATS.determineSearchType(searchTerm);
        switch (searchType) {
            case "address":
                ATS.createBlockies(searchTerm);
                $("#hiddenAddress").val(searchTerm);
                //$("#copyAddress").text(searchTerm);
                $(".walletBalance").text(
                    ATS.formatUSD(+data.result.totalBalanceUsd)
                );
                const blockchains = [];
                if (data.result.assets.length > 0) {
                    $("#tableLoadingRow").remove();
                    data.result.assets.map((asset) => {
                        if (asset.blockchain === "wan") {
                            $(".walletBalance").text(
                                ATS.formatUSD(+asset.balanceUsd)
                            );
                        }
                        if (blockchains.indexOf(asset.blockchain) == -1) {
                            blockchains.push(asset.blockchain);
                        }
                        let row = `<tr class="text-center" data-filter-string="${
                            asset.blockchain
                        }">
                            <td class="text-start"><img src="${
                                asset.thumbnail != ""
                                    ? asset.thumbnail
                                    : "assets/img/icon/coin-no-logo.svg"
                            }" style="width:25px; height:25px;" /> <b>${
                            asset.tokenSymbol
                        }</b></td>
                            <td>${asset.blockchain.toUpperCase()}</td>
                            <td>${asset.tokenType}</td>
                            <td>
                                ${
                                    asset.contractAddress
                                        ? `<a href='${ATS.siteUrl}${
                                              ATS.sitePath
                                          }address/${
                                              asset.contractAddress
                                          }'>${asset.contractAddress.slice(
                                              0,
                                              ATS.charLimit
                                          )}...</a>`
                                        : ""
                                }
                            </td>
                            <td>${asset.balance}</td>
                            <td>${ATS.formatUSD(+asset.tokenPrice)}</td>
                            <td>${ATS.formatUSD(+asset.balanceUsd)}</td>
                        </tr>`;

                        $("#assetsCoinTable tbody").append(row);
                    });

                    if (blockchains.length > 0) {
                        blockchains.map((bc) => {
                            //console.log(`#pills-${bc}-tab`);
                            $(`#pills-${bc}-tab`).removeClass("disabled");
                        });
                    }
                }
                break;
            case "tx":
                break;
            case "block":
                break;
        }
    },

    /// @method {ui}
    ///          applies the incoming data
    ///          to the transactions table
    applyDataToTransactionsTable: (data) => {
        const address = ATS.getSearchTermFromUrl();
        if (data.length > 0) {
            data.map((tx) => {
                if (!tx?.blockchain) tx.blockchain = "wan";
                let status = ATS.hexConverter(tx.status);
                let inout = tx.to === address ? "IN" : "OUT";
                let row = `
                    <tr class="text-start">
                        <td class="text-start">
                        <img src="assets/img/networkLogo/${
                            tx.blockchain
                        }.webp" width="24" height="24" alt="${
                    tx.blockchain
                } logo">
                        <a href='${ATS.siteUrl}${ATS.sitePath}tx/${
                    tx.blockchain
                }/${tx.hash}'>${tx.hash.slice(0, ATS.charLimit)}...</a></td>
                        <td><div class="p-2 rounded-1" style="display:flex; justify-content:center; align-items:center; font-size:12px; font-weight:bold; background-color: #F2F5FA; height: 30px;vertical-align: middle;">Transfer</div></td>
                        <td>${ATS.timeAgo(
                            ATS.hexConverter(tx.timestamp) * 1000
                        )}</td>
                        <td>${ATS.hexConverter(tx.blockNumber)}</td>
                        <td>
                            <a href='${ATS.siteUrl}${ATS.sitePath}address/${
                    tx.from
                }'>
                                ${tx.from.slice(0, ATS.charLimit)}...
                            </a>
                        </td>
                        <td>
                            <div class="p-2 rounded-1" style="display:flex; justify-content:center; align-items:center; font-size:12px; font-weight:bold; width:55px; background-color: ${
                                inout === "IN"
                                    ? "rgba(18, 147, 115, .5)"
                                    : "rgba(227, 54, 47, .5)"
                            }; color:${
                    inout === "IN"
                        ? "rgba(18, 147, 115, 1)"
                        : "rgba(227, 54, 47, 1)"
                }; height: 30px;vertical-align: middle;">
                                ${inout}
                            </div>
                        </td>
                        <td>
                            ${
                                tx.to === ""
                                    ? "-"
                                    : `<a href='${ATS.siteUrl}${ATS.sitePath}address/` +
                                      tx.to +
                                      "'>" +
                                      tx.to.slice(0, ATS.charLimit) +
                                      "...</a>"
                            }
                        </td>
                        <td>
                            ${ATS.removeTrailingZeros(
                                ATS.gweiToEther(ATS.hexConverter(tx.value))
                            )} ${ATS.blockchainToCoin[tx.blockchain]}
                        </td>
                    </tr>
                `;

                $("#transactionsTable tbody").append(row);
            });
        }
    },

    /// @method {ui}
    ///          applies the incoming data
    ///          to the transactions table
    applyDataToTokenTransfersTable: (data) => {
        const address = ATS.getSearchTermFromUrl();
        if (data.length > 0) {
            $("#tokenTransfersTable tbody tr").remove();
            data.map((tx) => {
                let inout = tx.toAddress === address ? "IN" : "OUT";
                let row = `
                    <tr class="text-start">
                        <td class="text-start">
                            <img src="assets/img/networkLogo/${
                                tx.blockchain
                            }.webp" width="24" height="24" alt="${
                    tx.blockchain
                } logo">
                        <a href='${ATS.siteUrl}${ATS.sitePath}tx/${
                    tx.blockchain
                }/${tx.transactionHash}'>${tx.transactionHash.slice(
                    0,
                    ATS.charLimit
                )}...</a></td>
                        <td>${ATS.timeAgo(tx.timestamp * 1000)}</td>
                        <td>
                            <a href='${ATS.siteUrl}${ATS.sitePath}address/${
                    tx.fromAddress
                }'>
                                ${tx.fromAddress.slice(0, ATS.charLimit)}...
                            </a>
                        </td>
                        <td>
                            <div class="p-2 rounded-1" style="display:flex; justify-content:center; align-items:center; font-size:12px; font-weight:bold; width:55px; background-color: ${
                                inout === "IN"
                                    ? "rgba(18, 147, 115, .5)"
                                    : "rgba(227, 54, 47, .5)"
                            }; color:${
                    inout === "IN"
                        ? "rgba(18, 147, 115, 1)"
                        : "rgba(227, 54, 47, 1)"
                }; height: 30px;vertical-align: middle;">
                                ${inout}
                            </div>
                        </td>
                        <td>
                            ${
                                tx.toAddress === ""
                                    ? "-"
                                    : `<a href='${ATS.siteUrl}${ATS.sitePath}address/` +
                                      tx.toAddress +
                                      "'>" +
                                      tx.toAddress.slice(0, ATS.charLimit) +
                                      "...</a>"
                            }
                        </td>
                        <td>
                            ${decimalZeroClear(
                                Math.ceil(
                                    (tx.value * 100000000) / 100000000
                                ).toLocaleString("en-EN", {
                                    minimumFractionDigits: 8,
                                    maximumFractionDigits: 8,
                                })
                            )}
                        </td>
                        <td><img src="${
                            tx.thumbnail != ""
                                ? tx.thumbnail
                                : "assets/img/icon/coin-no-logo.svg"
                        }" style="width:25px; height:25px;" /> ${
                    tx.tokenSymbol
                }</td>
                    </tr>
                `;

                $("#tokenTransfersTable tbody").append(row);
            });
        }
    },

    /// @method {ui}
    ///          applies the incoming data
    ///          to the nft transactions table
    applyDataToNftTransfersTable: (data) => {
        const address = ATS.getSearchTermFromUrl();

        if (data.length > 0) {
            data.map((tx) => {
                let inout = tx.toAddress === address ? "IN" : "OUT";
                let row = `
                    <tr class="text-center">
                        <td class="text-start"><a href='${ATS.siteUrl}${
                    ATS.sitePath
                }tx/${tx.blockchain}/${
                    tx.transactionHash
                }'>${tx.transactionHash.slice(0, ATS.charLimit)}...</a></td>
                        <td>${ATS.timeAgo(tx.timestamp * 1000)}</td>
                        <td>
                            <a href='${ATS.siteUrl}${ATS.sitePath}address/${
                    tx.fromAddress
                }'>
                                ${tx.fromAddress.slice(0, ATS.charLimit)}...
                            </a>
                        </td>
                        <td>
                            <div class="p-2 rounded-1" style="display:flex; justify-content:center; align-items:center; font-size:12px; font-weight:bold; width:55px; background-color: ${
                                inout === "IN"
                                    ? "rgba(18, 147, 115, .5)"
                                    : "rgba(227, 54, 47, .5)"
                            }; color:${
                    inout === "IN"
                        ? "rgba(18, 147, 115, 1)"
                        : "rgba(227, 54, 47, 1)"
                }; height: 30px;vertical-align: middle;">
                                ${inout}
                            </div>
                        </td>
                        <td>
                            ${
                                tx.toAddress === ""
                                    ? "-"
                                    : `<a href='${ATS.siteUrl}${ATS.sitePath}address/` +
                                      tx.toAddress +
                                      "'>" +
                                      tx.toAddress.slice(0, ATS.charLimit) +
                                      "...</a>"
                            }
                        </td>
                        <td>
                            ${tx.type}
                        </td>
                        <td><img src="${
                            tx.imageUrl != ""
                                ? tx.imageUrl
                                : "assets/img/icon/coin-no-logo.svg"
                        }" style="width:25px; height:25px;" /> ${
                    tx.collectionName
                }</td>
                    </tr>
                `;

                $("#allNFTable tbody").append(row);
            });
        }
    },

    applyHomeData(data) {
        // network logo : assets/images/networkLogo/eth.webp
        $("span.loading").remove();
        data.map((d) => {
            const latest_block_number =
                d.blockchain === "wan"
                    ? d.latest_block
                    : ATS.hexConverter(d.latest_block);
            const blockHtml = `
                <div class="row">
                    <div class="col-sm-4">
                        <div
                            class="d-flex align-items-center gap-2"
                        >
                            <div
                                class="d-none d-sm-flex content-center bg-light text-muted rounded p-2"
                                style="
                                    height: 3rem;
                                    width: 3rem;
                                "
                            >
                            <img src="${ATS.siteUrl}${
                ATS.sitePath
            }assets/img/networkLogo/${d.blockchain}.webp" />
                            </div>
                            <div
                                class="d-flex flex-row flex-sm-column align-items-center align-items-sm-start gap-1 gap-sm-0"
                            >
                                <span
                                    class="d-inline-block d-sm-none"
                                    >Block</span
                                ><a
                                    class="text-truncate"
                                    style="max-width: 6rem"
                                    href="${ATS.sitePath}block/${
                d.blockchain
            }/${latest_block_number}"
                                    >${latest_block_number}</a
                                >
                                <div class="small text-muted">
                                    ${
                                        d.blockchain === "wan"
                                            ? ATS.timeAgo(d.timestamp)
                                            : ATS.timeAgo(
                                                  ATS.hexConverter(
                                                      d.timestamp
                                                  ) * 1000
                                              )
                                    }
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-sm-8 d-flex justify-content-sm-between align-items-end align-items-sm-center position-relative"
                    >
                        <div class="pe-0 pe-sm-2"></div>
                        <div class="d-none d-sm-block text-end ms-2 ms-sm-0">
                            <span
                                class="badge border border-dark dark:border-white border-opacity-15 text-dark fw-medium py-1.5 px-2"
                                data-bs-toggle="tooltip">${d.txs} Txns</span
                            >
                        </div>
                    </div>
                </div>
                <hr />
            `;

            /// sometimes block number come NaN
            /// the if below checks it if it is not NaN
            /// then appends the row to the table
            if (!isNaN(ATS.hexConverter(d.latest_block))) {
                $(".latestBlocksContainer").append(blockHtml);
            }

            const transactionHtml = `
                <div class="row">
                    <div class="col-sm-4 col-lg-5">
                        <div
                            class="d-flex align-items-center gap-2"
                        >
                            <div
                                class="d-none d-sm-flex content-center bg-light text-muted rounded p-3"
                                style="
                                    height: 3rem;
                                    width: 3rem;
                                "
                            >
                                <i
                                    class="fal fa-memo fs-lg"
                                ></i>
                            </div>
                            <div
                                class="d-flex align-items-center align-items-sm-start flex-row flex-sm-column gap-1 gap-sm-0"
                            >
                                <span
                                    class="d-inline-block d-sm-none"
                                    >TX#</span
                                ><a
                                    class="d-block text-truncate"
                                    style="max-width: 8rem"
                                    href="/tx/${
                                        d.blockchain ? d.blockchain : "wan"
                                    }/${d.latest_transactions.hash}"
                                    >${d.latest_transactions.hash}</a
                                >
                                <div class="small text-muted">
                                    ${ATS.timeAgo(
                                        ATS.hexConverter(
                                            d.latest_transactions.timestamp
                                        ) * 1000
                                    )}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-sm-8 col-lg-7 d-flex justify-content-sm-between align-items-end align-items-sm-center"
                    >
                        <div class="pe-0 pe-sm-2">
                            <div class="d-flex flex-wrap gap-1">
                                From
                                <a
                                    href="${ATS.siteUrl}${
                ATS.sitePath
            }address/${d.latest_transactions.from}"
                                    data-bs-toggle="tooltip"
                                    >${d.latest_transactions.from.slice(
                                        0,
                                        ATS.charLimit
                                    )}</a
                                >
                            </div>
                            <div
                                class="d-flex align-items-center flex-wrap gap-1"
                            >
                                To
                                <a
                                    href="${ATS.siteUrl}${
                ATS.sitePath
            }address/${d.latest_transactions.to}"
                                    data-bs-toggle="tooltip"
                                    >${d.latest_transactions.to.slice(
                                        0,
                                        ATS.charLimit
                                    )}</a
                                >
                            </div>
                        </div>
                        <div
                            class="d-none d-sm-block text-end ms-2 ms-sm-0"
                            data-bs-toggle="tooltip"
                        >
                            <span
                                class="badge border border-dark dark:border-white border-opacity-15 text-dark py-1.5 px-2 fw-medium"
                                ></b>${ATS.removeTrailingZeros(
                                    ATS.gweiToEther(
                                        ATS.hexConverter(
                                            d.latest_transactions.value
                                        )
                                    )
                                )} ${ATS.blockchainToCoin[d.blockchain]}</span
                            >
                        </div>
                    </div>
                </div>
                <hr />
            `;

            $(".latestTransactionsContainer").append(transactionHtml);
        });
    },

    applyBlockListData: (data, blockId) => {
        if (data.length > 0) {
            $(".loading").remove();
            data.map((d) => {
                const { blocks } = d.result;
                if (blocks[0]) {
                    const dt = blocks[0];
                    const row = `
                        <tr class="text-center">
                            <td class="text-start"><img src="${ATS.siteUrl}${
                        ATS.sitePath
                    }assets/img/networkLogo/${
                        dt.blockchain
                    }.webp" width="32" height="32"> <b><a href="${ATS.siteUrl}${
                        ATS.sitePath
                    }block/${dt.blockchain}/${ATS.hexConverter(
                        dt.number
                    )}">${ATS.hexConverter(dt.number)}</a></b></td>
                            <td>${ATS.timeAgo(
                                ATS.hexConverter(dt.timestamp) * 1000
                            )}</td>
                            <td>${dt.transactions?.length}</td>
                            <td>${dt.hash.slice(0, ATS.charLimit)}...</td>
                            <td>${ATS.hexConverter(dt.gasLimit)}</td>
                            <td>${ATS.hexConverter(dt.gasUsed)}</td>
                            <td>${dt.miner.slice(0, ATS.charLimit)}</td>
                        </tr>
                    `;

                    $("#blockListTable tbody").append(row);
                }
            });
        }
    },

    applyDataToTransactionsListTable: (data) => {
        $("#transactionListTable tbody tr").remove();
        data.map((tx) => {
            const blockchain =
                tx.blockChain && tx.blockChain === "WAN"
                    ? "wan"
                    : tx.blockchain;
            const url = ATS.siteUrl + ATS.sitePath;
            const row = `
                <tr class="text-center">
                    <td class="text-start">
                        <a href='${url}tx/${blockchain}/${
                tx.hash
            }'><img style="width:25px; height:25px;" src="${ATS.siteUrl}${
                ATS.sitePath
            }/assets/img/networkLogo/${blockchain}.webp"> ${tx.hash.slice(
                0,
                ATS.charLimit
            )}...</a>
                    </td>
                    <td>
                        <a href='${url}block/${blockchain}/${ATS.hexConverter(
                tx.blockNumber
            )}'>${ATS.hexConverter(tx.blockNumber)}</a>
                    </td>
                    <td>${ATS.timeAgo(
                        ATS.hexConverter(tx.timestamp) * 1000
                    )}</td>
                    <td><a href='${url}address/${tx.from}'>${tx.from.slice(
                0,
                ATS.charLimit
            )}...</a></td>
                    <td><a href='${url}address/${tx.to}'>${tx.to.slice(
                0,
                ATS.charLimit
            )}...</a></td>
                    <td>${ATS.hexConverter(tx.value)} ${
                ATS.blockchainToCoin[blockchain]
            }</td>
                </tr>
            `;

            $("#transactionListTable tbody").append(row);
        });
    },

    applyBlockInfoData: (data) => {
        const blockNum = ATS.hexConverter(data.number);
        ATS.createBlockies(data.miner);
        //$(".blockNum").html(blockNum);
        $("span[data-col='blockchain']").html(data?.blockchain);
        $("span[data-col='blocknumber']").html(ATS.hexConverter(data.number));
        $("span[data-col='timestamp']").html(
            ATS.timeAgo(ATS.hexConverter(data.timestamp) * 1000)
        );
        $("span[data-col='txns']").html(data.transactions.length);
        $("span[data-col='miner']").html(
            `<a href='${ATS.siteUrl}${ATS.sitePath}address/${data.miner}'>${data.miner}</a>`
        );
        $("span[data-col='size']").html(ATS.hexConverter(data.size));
        $("span[data-col='gasused']").html(ATS.hexConverter(data.gasUsed));
        $("span[data-col='gaslimit']").html(ATS.hexConverter(data.gasLimit));
        $("span[data-col='extradata']").html(data.extraData);
        $("span[data-col='blockhash']").html(data.hash);
        $("span[data-col='parenthash']").html(
            `<a href='${ATS.siteUrl}${ATS.sitePath}block/${data.blockchain}/${
                ATS.hexConverter(data.number) - 1
            }'>${data.parentHash}</a>`
        );
        $("span[data-col='uncles']").html(data.sha3Uncles);
        $("span[data-col='stateroot']").html(data.stateRoot);
    },

    applyDataToTransactionInfoTable: (data) => {
        ATS.createBlockies(data.hash);
        //$("span.txHash").html(data.hash);
        $("input.txHash").val(data.hash);
        if (data.blockChain && data.blockChain === "WAN") {
            $(`span[data-col="blockchain"]`).html(
                data.blockChain.toUpperCase()
            );
            $(`span[data-col="hash"]`).html(
                `<a href='${ATS.siteUrl}${ATS.sitePath}transactions/${data.hash}'>${data.hash}</a>`
            );
            const status = ATS.hexConverter(data.status);
            $(`span[data-col="status"]`).html(
                `${status === 1 ? "🟢 Success" : "🔴 Failed"}`
            );
            $(`span[data-col="blockNumber"]`).html(
                `<a href='${ATS.siteUrl}${
                    ATS.sitePath
                }block/${data.blockChain.toLowerCase()}/${data.blockNumber}'>#${
                    data.blockNumber
                }</a>`
            );
            $(`span[data-col="timestamp"]`).html(
                ATS.timeAgo(ATS.hexConverter(data.timestamp) * 1000)
            );
            $(`span[data-col="from"]`).html(
                `<a href='${ATS.siteUrl}${ATS.sitePath}address/${data.from}'>${data.from}</a>`
            );
            $(`span[data-col="to"]`).html(
                `<a href='${ATS.siteUrl}${ATS.sitePath}address/${data.to}'>${data.to}</a>`
            );
            $(`span[data-col="value"]`).html(
                ATS.gweiToEther(ATS.hexConverter(data.value)) +
                    " " +
                    ATS.blockchainToCoin[data.blockchain]
            );
            $(`span[data-col="gas"]`).html(ATS.hexConverter(data.gas));
            $(`span[data-col="gasPrice"]`).html(
                ATS.gweiToEther(ATS.hexConverter(data.gasPrice)) +
                    " " +
                    ATS.blockchainToCoin[data.blockchain]
            );
        } else {
            $(`span[data-col="blockchain"]`).html(
                data.blockchain.toUpperCase()
            );
            $(`span[data-col="hash"]`).html(
                `<a href='${ATS.siteUrl}${ATS.sitePath}transactions/${data.hash}'>${data.hash}</a>`
            );
            const status = ATS.hexConverter(data.status);
            $(`span[data-col="status"]`).html(
                `${status === 1 ? "🟢 Success" : "🔴 Failed"}`
            );
            $(`span[data-col="blockNumber"]`).html(
                `<a href='${ATS.siteUrl}${ATS.sitePath}block/${
                    data.blockchain
                }/${ATS.hexConverter(data.blockNumber)}'>#${ATS.hexConverter(
                    data.blockNumber
                )}</a>`
            );
            $(`span[data-col="timestamp"]`).html(
                ATS.timeAgo(ATS.hexConverter(data.timestamp) * 1000)
            );
            $(`span[data-col="from"]`).html(
                `<a href='${ATS.siteUrl}${ATS.sitePath}address/${data.from}'>${data.from}</a>`
            );
            $(`span[data-col="to"]`).html(
                `<a href='${ATS.siteUrl}${ATS.sitePath}address/${data.to}'>${data.to}</a>`
            );
            $(`span[data-col="value"]`).html(
                ATS.gweiToEther(ATS.hexConverter(data.value)) +
                    " " +
                    ATS.blockchainToCoin[data.blockchain]
            );
            $(`span[data-col="gas"]`).html(ATS.hexConverter(data.gas));
            $(`span[data-col="gasPrice"]`).html(
                ATS.gweiToEther(ATS.hexConverter(data.gasPrice)) +
                    " " +
                    ATS.blockchainToCoin[data.blockchain]
            );
        }
    },

    /// ========== GETTER METHODS ==========

    /// @method {getter}
    ///          gets platform list from token name
    getTokenPlatformList: async () => {
        const searchTerm = decodeURI(ATS.getSearchTermFromUrl().toLowerCase());
        const tokenFetch = await fetch(
            `${ATS.siteUrl}${ATS.sitePath}assets/doc/allCoinList.json`
        );
        const tokensList = await tokenFetch.json();
        const tokensSearch = tokensList.filter(
            (tkn) =>
                tkn.name
                    .toLowerCase()
                    .replace(/ /g, "--")
                    .includes(searchTerm) ||
                tkn.symbol
                    .toLowerCase()
                    .replace(/ /g, "--")
                    .includes(searchTerm)
        );
        $("#tokenPlatformsTable tbody tr").remove();
        if (tokensSearch.length > 0) {
            tokensSearch.map((tknRow) => {
                let platforms = "";
                Object.keys(tknRow.platforms).forEach((v, k) => {
                    if (ATS.availablePlatforms.indexOf(v) != -1) {
                        platforms += `<tag class='platformTag' style="background:#f3f3f3; padding:2px 4px; border-radius:4px; margin-right:5px; margin-bottom:5px;"><a href='${ATS.siteUrl}${ATS.sitePath}address/${tknRow.platforms[v]}'>${v}</a></tag>`;
                    }
                });
                const row = `
                    <tr>
                        <td>${tknRow.name}</td>
                        <td>${tknRow.symbol}</td>
                        <td>${platforms}</td>
                    </tr>
                `;

                if (Object.keys(tknRow.platforms).length > 0 && platforms != "")
                    $("#tokenPlatformsTable tbody").append(row);
            });
        }
    },

    /// @method {getter}
    ///          gets the searchTerm from the page url
    getSearchTermFromUrl: () => {
        return window.location.pathname.split("/")[2];
    },

    /// @method : getter
    getPageData: async () => {
        const PageData = await ATS.getData(ATS.getSearchTermFromUrl());
        ATS.applyData(PageData);
    },

    /// @method : getter
    getHomePageData: async () => {
        try {
            const response = await fetch(`${ATS.apiUrl}blocks`);
            const homeData = await response.json();
            ATS.applyHomeData(homeData);
        } catch (err) {
            throw new Error(err.message);
        }
    },

    /// @method : getter
    getBlockData: async () => {
        const blockId = ATS.getSearchTermFromUrl();
        const data = await fetch(`${ATS.apiUrl}search/${blockId}`);
        const blockData = await data.json();
        ATS.applyBlockListData(blockData, blockId);
    },

    /// @method : getter
    getBlockInfo: async () => {
        const blockChain = ATS.getSearchTermFromUrl();
        const blockId = location.pathname.split("/")[3];
        const data = await fetch(`${ATS.apiUrl}block/${blockChain}/${blockId}`);
        const blockData = await data.json();
        if (!blockData.hasOwnProperty("result")) {
            /// @note:
            /// if there is no key called blockchain in the object
            /// it means that the incoming blockchain is WAN
            const blocks = blockData;
            blocks.blockchain = "wan";
            ATS.applyBlockInfoData(blocks);
        } else {
            const { blocks } = blockData.result;
            if (blocks[0]) {
                ATS.applyBlockInfoData(blocks[0]);
            }
        }
    },

    /// @method: getter
    ///          returns all the transactions of wallet
    ///          address that sent
    ///          data->result->transactions[];
    getTxByAddress: async () => {
        if ($("#transactionsTable tbody tr").length < 1) {
            const address = ATS.getSearchTermFromUrl();
            try {
                const response = await fetch(
                    `${ATS.apiUrl}tx-address/${address}`
                );
                const transactionsData = await response.json();
                const result = await transactionsData.result;
                ATS.applyDataToTransactionsTable(
                    result?.is_wan_included
                        ? result?.transactions[0]
                        : result?.transactions
                );
            } catch (err) {
                throw new Error(err.message);
            }
        }
    },

    /// @method: getter
    ///          returns all the nft transfers of wallet
    ///          address that sent
    ///          data->result->transactions[];
    getNftTransfersByAddress: async () => {
        if ($("#allNFTable tbody tr").length < 1) {
            const address = ATS.getSearchTermFromUrl();
            try {
                const response = await fetch(
                    `${ATS.apiUrl}/nft-transfers/address/${address}`
                );
                const transactionsData = await response.json();
                const transactions = transactionsData.result.transfers;
                ATS.applyDataToNftTransfersTable(transactions);
            } catch (err) {
                throw new Error(err.message);
            }
        }
    },

    /// @method {getter}
    /// @param {string} : searchTerm
    ///          fetchs the endpoint -> /search/
    ///          and returns the search data
    getData: async (searchTerm) => {
        try {
            const response = await fetch(`${ATS.apiUrl}search/${searchTerm}`);
            const searchData = await response.json();
            return searchData;
        } catch (err) {
            throw new Error(err.message);
        }
    },

    /// @method {getter}
    /// @param {string} : searchTerm
    getTokenTransfersByAddress: async (address) => {
        try {
            const response = await fetch(
                `${
                    ATS.apiUrl
                }/token-transfers/address/${ATS.getSearchTermFromUrl()}`
            );
            const tokenTransfersData = await response.json();
            ATS.applyDataToTokenTransfersTable(
                tokenTransfersData.result.transfers
            );
            return tokenTransfersData;
        } catch (err) {
            throw new Error(err.message);
        }
    },

    /// @method {getter}
    getTransactionInfo: async () => {
        return new Promise(async (resolve, reject) => {
            const blockchain = window.location.pathname.split("/")[2];
            const transactionHash = window.location.pathname.split("/")[3];
            const response = await fetch(
                `${ATS.apiUrl}tx/${blockchain}/${transactionHash}`
            );
            const transactionInfo = await response.json();

            ATS.applyDataToTransactionInfoTable(
                transactionInfo.blockChain === "WAN"
                    ? transactionInfo
                    : transactionInfo.result.transactions[0]
            );
        });
    },

    /// @method {getter}
    getTransactionsList: async () => {
        return new Promise(async (resolve, reject) => {
            const transactionHash = window.location.pathname.split("/")[2];
            const response = await fetch(
                `${ATS.apiUrl}transactions/${transactionHash}`
            );
            const transactionsList = await response.json();

            ATS.applyDataToTransactionsListTable(
                transactionsList.result.transactions
            );
        });
    },

    /// ========== UTILITY METHODS ==========

    filterTable(tableId, filter) {
        const hiddenClass = "d-none";
        $(`#${tableId} tbody tr.${hiddenClass}`).removeClass(hiddenClass);
        if (filter != "all") {
            const rows = $(
                `#${tableId} tbody tr[data-filter-string!="${filter}"]`
            ).addClass(hiddenClass);
        }
    },

    isEthereumAddress(address) {
        if (!/^(0x)?[0-9a-f]{40}$/i.test(address)) {
            // address is not a valid Ethereum wallet address
            return false;
        }
        // address is a valid Ethereum wallet address
        return true;
    },

    isBlockNumber(searchTerm) {
        return /^\d{8,10}$/.test(searchTerm);
    },

    /// @method {utility}
    ///          Determines the type of the searchTerm
    ///          coming from the Search Input
    determineSearchType: async (term) => {
        return new Promise((resolve, reject) => {
            if (term.includes(".")) {
                // domain search
                resolve("domain");
            } else if (term.toLowerCase().includes("0x") && term.length > 60) {
                // transaction search
                resolve("tx");
            } else if (ATS.isBlockNumber(term)) {
                // block id search
                resolve("blocklist");
            } else if (ATS.isEthereumAddress(term)) {
                // wallet address search
                resolve("address");
            } else {
                resolve("token");
            }
        });
    },

    /// @method {utility}
    ///          returns the given number formatted to
    ///          the US Dollar string
    formatUSD: (num) => {
        return "$" + num.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
    },

    /// @method {utility}
    /// @param {number}: timestamp
    ///         gets the timestamp and
    ///         returns time ago text
    timeAgo: (time) => {
        switch (typeof time) {
            case "number":
                time = time;
                break;
            case "string":
                time = +new Date(time);
                break;
            case "object":
                if (time.constructor === Date) time = time.getTime();
                break;
            default:
                time = +new Date();
        }
        var time_formats = [
            [60, "seconds", 1], // 60
            [120, "1 minute ago", "1 minute from now"], // 60*2
            [3600, "minutes", 60], // 60*60, 60
            [7200, "1 hour ago", "1 hour from now"], // 60*60*2
            [86400, "hours", 3600], // 60*60*24, 60*60
            [172800, "Yesterday", "Tomorrow"], // 60*60*24*2
            [604800, "days", 86400], // 60*60*24*7, 60*60*24
            [1209600, "Last week", "Next week"], // 60*60*24*7*4*2
            [2419200, "weeks", 604800], // 60*60*24*7*4, 60*60*24*7
            [4838400, "Last month", "Next month"], // 60*60*24*7*4*2
            [29030400, "months", 2419200], // 60*60*24*7*4*12, 60*60*24*7*4
            [58060800, "Last year", "Next year"], // 60*60*24*7*4*12*2
            [2903040000, "years", 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12
            [5806080000, "Last century", "Next century"], // 60*60*24*7*4*12*100*2
            [58060800000, "centuries", 2903040000], // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100
        ];
        var seconds = (+new Date() - time) / 1000,
            token = "ago",
            list_choice = 1;

        if (seconds == 0) {
            return "Just now";
        }
        if (seconds < 0) {
            seconds = Math.abs(seconds);
            token = "from now";
            list_choice = 2;
        }
        var i = 0,
            format;
        while ((format = time_formats[i++]))
            if (seconds < format[0]) {
                if (typeof format[2] == "string") return format[list_choice];
                else
                    return (
                        Math.floor(seconds / format[2]) +
                        " " +
                        format[1] +
                        " " +
                        token
                    );
            }
        return time;
    },

    /// @method {utility}
    /// @param  {string}
    ///         converts the given hex to
    ///         decimal number
    hexConverter: (hex) => {
        return parseInt(hex, 16);
    },

    /// @method {utility}
    /// @param  {number}
    ///         converts the given gwei to eth
    gweiToEther: (gwei) => {
        const ether = gwei / 1000000000000000000;
        return ether.toFixed(9);
    },

    /// @method {utility}
    /// @param  {number}: num
    ///         removes the trailing zeros
    // @example : 0.123400 -> 0.1234
    removeTrailingZeros: (num) => {
        let numParam = num.toString().replace(/(\.\d*?[1-9])0+$/g, "$1");
        return numParam > 0 ? numParam : 0;
    },
};

$(function () {
    // ATS.resultPageClasses.map((className) => {
    //     document.querySelectorAll(`.${className}`).length > 0 &&
    //         ATS.getPageData();
    // });
    // if ($("#assetsCoinTable").length > 0) {
    //console.log(1111);
    if ($("#transactionsTable").length > 0) {
        $("button[data-filter]").click((btn) => {
            // ATS.filterTable(
            //     "assetsCoinTable",
            //     btn.currentTarget.dataset.filter
            // );
            ATS.filterTable(
                "transactionsTable",
                btn.currentTarget.dataset.filter
            );
        });
    }
    // if (document.querySelectorAll(".allToScanResult_blocklist").length > 0) {
    //     ATS.getBlockData();
    // }
    // if (window.location.pathname == ATS.sitePath) {
    //     ATS.getHomePageData();
    // }
    // if (window.location.pathname.includes("blocklist")) {
    //     ATS.getBlockData();
    // }
    // if ($("#blockInfoTable").length > 0) {
    //     ATS.getBlockInfo();
    // }
    // if ($(".transactionInfo").length > 0) {
    //     ATS.getTransactionInfo();
    // }
    // if ($("#transactionListTable").length > 0) {
    //     ATS.getTransactionsList();
    // }
    // if ($("#tokenPlatformsTable").length > 0) {
    //     ATS.getTokenPlatformList();
    // }
});
