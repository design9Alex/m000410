<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Minmax\Article\Models\ArticleBlock;
use Minmax\Article\Models\ArticleCategory;
use Minmax\Base\Helpers\Log as LogHelper;
use Minmax\Foundation\Contracts\WebController as BaseController;
use Minmax\Inbox\Web\InboxReceivedRepository;

/**
 * Class JsonController
 *
 * @package App\Http\Controllers\Web
 */
class JsonController extends BaseController
{
    protected $defaultArr;

    public function __construct(){

        $this->defaultArr = [
            "income_statement" => [
                "unit" => [
                    "百萬新台幣",
                    "元"
                ],
                "scales" => [
                    "year" => [
                        "x" => [
                            "ticks" => [
                                "color" => "#000000",
                                "padding" => 9,
                                "font" => [
                                    "family" => "'Roboto'",
                                    "weight" => 600,
                                    "size" => 18
                                ]
                            ],
                            "grid" => [
                                "color" => "#f2f1f1"
                            ]
                        ],
                        "y" => [
                            "beginAtZero" => true,
                            "ticks" => [
                                "padding" => 30,
                                "color" => "#B2B2B2",
                                "font" => [
                                    "family" => "'Roboto'",
                                    "weight" => 500,
                                    "size" => 14
                                ]
                            ],
                            "grid" => [
                                "color" => "#f2f1f1"
                            ]
                        ],
                        "y2" => [
                            "beginAtZero" => true,
                            "position" => "right",
                            "ticks" => [
                                "padding" => 30,
                                "color" => "#B2B2B2",
                                "font" => [
                                    "family" => "'Roboto'",
                                    "weight" => 500,
                                    "size" => 14
                                ]
                            ],
                            "grid" => [
                                "color" => "#f2f1f1"
                            ]
                        ]
                    ],
                    "quarter" => [
                        "x" => [
                            "ticks" => [
                                "color" => "#000000",
                                "padding" => 9,
                                "font" => [
                                    "family" => "'Roboto'",
                                    "weight" => 600,
                                    "size" => 18
                                ]
                            ],
                            "grid" => [
                                "color" => "#f2f1f1"
                            ]
                        ],
                        "y" => [
                            "beginAtZero" => true,
                            "ticks" => [
                                "padding" => 30,
                                "color" => "#B2B2B2",
                                "font" => [
                                    "family" => "'Roboto'",
                                    "weight" => 500,
                                    "size" => 14
                                ]
                            ],
                            "grid" => [
                                "color" => "#f2f1f1"
                            ]
                        ],
                        "y2" => [
                            "beginAtZero" => true,
                            "position" => "right",
                            "ticks" => [
                                "padding" => 30,
                                "color" => "#B2B2B2",
                                "font" => [
                                    "family" => "'Roboto'",
                                    "weight" => 500,
                                    "size" => 14
                                ]
                            ],
                            "grid" => [
                                "color" => "#f2f1f1"
                            ]
                        ]
                    ]
                ],
                "title" => [
                    "year" => [
                        [
                            "key" => "income",
                            "title" => "營業收入",
                            "label" => "營業收入",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 36,
                            "categoryPercentage" => 0.9,
                            "borderRadius" => 4,
                            "backgroundColor" => "#6BA2D0"
                        ],
                        [
                            "key" => "grossprofit",
                            "title" => "營業毛利",
                            "label" => "營業毛利",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 36,
                            "categoryPercentage" => 0.9,
                            "borderRadius" => 4,
                            "backgroundColor" => "#D65C5C"
                        ],
                        [
                            "key" => "revenue",
                            "title" => "營業利益",
                            "label" => "營業利益",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 36,
                            "categoryPercentage" => 0.9,
                            "borderRadius" => 4,
                            "backgroundColor" => "#A5A5A5"
                        ],
                        [
                            "key" => "netincome",
                            "title" => "稅前淨利",
                            "label" => "稅前淨利",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 36,
                            "categoryPercentage" => 0.9,
                            "borderRadius" => 4,
                            "backgroundColor" => "#C29772"
                        ],
                        [
                            "key" => "cpynetincome",
                            "title" => "歸屬於母公司淨利",
                            "label" => "歸屬於母公司淨利",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 36,
                            "categoryPercentage" => 0.9,
                            "borderRadius" => 4,
                            "backgroundColor" => "#7579BB"
                        ],
                        [
                            "key" => "eps10",
                            "title" => "<div>股票面額 10元計</div><div>稅後EPS (元)</div>",
                            "label" => "股票面額 10元計計稅後EPS(元)",
                            "type" => "line",
                            "yAxisID" => "y2",
                            "tension" => 0.55,
                            "pointBorderWidth" => 5,
                            "borderColor" => "#76BEC0",
                            "backgroundColor" => "#76BEC0"
                        ],
                        [
                            "key" => "eps1",
                            "title" => "<div>股票面額 1元計</div><div>稅後EPS (元)</div>",
                            "label" => "股票面額 1元計稅後EPS (元)",
                            "type" => "line",
                            "yAxisID" => "y2",
                            "tension" => 0.55,
                            "pointBorderWidth" => 5,
                            "borderColor" => "#CDD55B",
                            "backgroundColor" => "#CDD55B"
                        ]
                    ],
                    "quarter" => [
                        [
                            "key" => "income",
                            "title" => "營業收入",
                            "label" => "營業收入",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 36,
                            "categoryPercentage" => 0.9,
                            "borderRadius" => 4,
                            "backgroundColor" => "#6BA2D0"
                        ],
                        [
                            "key" => "grossprofit",
                            "title" => "營業毛利",
                            "label" => "營業毛利",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 36,
                            "categoryPercentage" => 0.9,
                            "borderRadius" => 4,
                            "backgroundColor" => "#D65C5C"
                        ],
                        [
                            "key" => "revenue",
                            "title" => "營業利益",
                            "label" => "營業利益",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 36,
                            "categoryPercentage" => 0.9,
                            "borderRadius" => 4,
                            "backgroundColor" => "#A5A5A5"
                        ],
                        [
                            "key" => "netincome",
                            "title" => "稅前淨利",
                            "label" => "稅前淨利",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 36,
                            "categoryPercentage" => 0.9,
                            "borderRadius" => 4,
                            "backgroundColor" => "#C29772"
                        ],
                        [
                            "key" => "cpynetincome",
                            "title" => "歸屬於母公司淨利",
                            "label" => "歸屬於母公司淨利",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 36,
                            "categoryPercentage" => 0.9,
                            "borderRadius" => 4,
                            "backgroundColor" => "#7579BB"
                        ],
                        [
                            "key" => "eps10",
                            "title" => "<div>股票面額 10元計</div><div>稅後EPS (元)</div>",
                            "label" => "股票面額 10元計計稅後EPS(元)",
                            "type" => "line",
                            "yAxisID" => "y2",
                            "tension" => 0.55,
                            "pointBorderWidth" => 5,
                            "borderColor" => "#76BEC0",
                            "backgroundColor" => "#76BEC0"
                        ],
                        [
                            "key" => "eps1",
                            "title" => "<div>股票面額 1元計</div><div>稅後EPS (元)</div>",
                            "label" => "股票面額 1元計稅後EPS (元)",
                            "type" => "line",
                            "yAxisID" => "y2",
                            "tension" => 0.55,
                            "pointBorderWidth" => 5,
                            "borderColor" => "#CDD55B",
                            "backgroundColor" => "#CDD55B"
                        ]
                    ]
                ],
                "year" => [

                    "2018" => [
                        "income" => "15,757",
                        "grossprofit" => "2,321",
                        "revenue" => "1,390",
                        "netincome" => "1,748",
                        "cpynetincome" => "856",
                        "eps10" => "13.47",
                        "eps1" => "1.35"
                    ],
                    "2019" => [
                        "income" => "15,757",
                        "grossprofit" => "2,321",
                        "revenue" => "1,390",
                        "netincome" => "1,748",
                        "cpynetincome" => "856",
                        "eps10" => "13.47",
                        "eps1" => "1.35"
                    ],

                ],
                "quarter" => [
                    "21Q2" => [
                        "income" => "4,901",
                        "grossprofit" => "871",
                        "revenue" => "563",
                        "netincome" => "593",
                        "cpynetincome" => "338",
                        "eps10" => "4.9",
                        "eps1" => "0.49"
                    ],
                    "21Q3" => [
                        "income" => "5,472",
                        "grossprofit" => "1,157",
                        "revenue" => "747",
                        "netincome" => "1,143",
                        "cpynetincome" => "703",
                        "eps10" => "10.2",
                        "eps1" => "1.02"
                    ],
                    "21Q4" => [
                        "income" => "5703",
                        "grossprofit" => "1433",
                        "revenue" => "846",
                        "netincome" => "907",
                        "cpynetincome" => "448",
                        "eps10" => "6.5",
                        "eps1" => "0.65"
                    ],
                    "22Q1" => [
                        "income" => "5655",
                        "grossprofit" => "1313",
                        "revenue" => "918",
                        "netincome" => "1154",
                        "cpynetincome" => "592",
                        "eps10" => "8.6",
                        "eps1" => "0.86"
                    ],
                    "22Q2" => [
                        "income" => "5820",
                        "grossprofit" => "1343",
                        "revenue" => "939",
                        "netincome" => "1189",
                        "cpynetincome" => "539",
                        "eps10" => "7.9",
                        "eps1" => "0.79"
                    ],
                    "QoQ" => [
                        "income" => "2.90%",
                        "grossprofit" => "2.30%",
                        "revenue" => "2.30%",
                        "netincome" => "3%",
                        "cpynetincome" => "-9%",
                        "eps10" => "-8.10%",
                        "eps1" => "-8.10%"
                    ],
                    "YoY" => [
                        "income" => "18.80%",
                        "grossprofit" => "54.20%",
                        "revenue" => "66.80%",
                        "netincome" => "100.50%",
                        "cpynetincome" => "59.50%",
                        "eps10" => "61.20%",
                        "eps1" => "61.20%"
                    ]
                ]
            ],

            "balance_sheet" => [
                "unit" => [
                    "百萬新台幣",
                    "%"
                ],
                "scales" => [
                    "year" => [
                        "x" => [
                            "ticks" => [
                                "color" => "#000000",
                                "padding" => 9,
                                "font" => [
                                    "family" => "'Roboto'",
                                    "weight" => 600,
                                    "size" => 18
                                ]
                            ],
                            "grid" => [
                                "color" => "#f2f1f1"
                            ]
                        ],
                        "y" => [
                            "beginAtZero" => true,
                            "ticks" => [
                                "padding" => 30,
                                "color" => "#B2B2B2",
                                "font" => [
                                    "family" => "'Roboto'",
                                    "weight" => 500,
                                    "size" => 14
                                ]
                            ],
                            "grid" => [
                                "color" => "#f2f1f1"
                            ]
                        ],
                        "y2" => [
                            "beginAtZero" => true,
                            "position" => "right",
                            "ticks" => [
                                "padding" => 30,
                                "color" => "#B2B2B2",
                                "font" => [
                                    "family" => "'Roboto'",
                                    "weight" => 500,
                                    "size" => 14
                                ]
                            ],
                            "grid" => [
                                "color" => "#f2f1f1"
                            ]
                        ]
                    ]
                ],
                "title" => [
                    "year" => [
                        [
                            "key" => "cash",
                            "title" => "現金及約當現金",
                            "label" => "現金及約當現金",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 36,
                            "categoryPercentage" => 0.9,
                            "borderRadius" => 4,
                            "backgroundColor" => "#6BABE0"
                        ],
                        [
                            "key" => "receiveable",
                            "title" => "應收帳款淨額",
                            "label" => "應收帳款淨額",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 36,
                            "categoryPercentage" => 0.9,
                            "borderRadius" => 4,
                            "backgroundColor" => "#91CBE8"
                        ],
                        [
                            "key" => "currentassets",
                            "title" => "流動資產",
                            "label" => "流動資產",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 36,
                            "categoryPercentage" => 0.9,
                            "borderRadius" => 4,
                            "backgroundColor" => "#A5A5A5"
                        ],
                        [
                            "key" => "equityinvestments",
                            "title" => "採用權益法之投資",
                            "label" => "採用權益法之投資",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 36,
                            "categoryPercentage" => 0.9,
                            "borderRadius" => 4,
                            "backgroundColor" => "#D1B194"
                        ],
                        [
                            "key" => "currentliabilities",
                            "title" => "流動負債",
                            "label" => "流動負債",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 36,
                            "categoryPercentage" => 0.9,
                            "borderRadius" => 4,
                            "backgroundColor" => "#999BCC"
                        ],
                        [
                            "key" => "noncurrentliabilities",
                            "title" => "非流動負債",
                            "label" => "非流動負債",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 36,
                            "categoryPercentage" => 0.9,
                            "borderRadius" => 4,
                            "backgroundColor" => "#D194B0"
                        ],
                        [
                            "key" => "totalequity",
                            "title" => "權益總計",
                            "label" => "權益總計",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 36,
                            "categoryPercentage" => 0.9,
                            "borderRadius" => 4,
                            "backgroundColor" => "#769AC0"
                        ],
                        [
                            "key" => "totalassets",
                            "title" => "總資產",
                            "label" => "總資產",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 36,
                            "categoryPercentage" => 0.9,
                            "borderRadius" => 4,
                            "backgroundColor" => "#CC6666"
                        ],
                        [
                            "key" => "netincome10",
                            "title" => "<div>股票面額 10元計</div><div>每股淨值 (元)</div>",
                            "label" => "股票面額 10元計每股淨值 (元)",
                            "type" => "line",
                            "yAxisID" => "y2",
                            "tension" => 0.55,
                            "pointBorderWidth" => 5,
                            "borderColor" => "#76BEC0",
                            "backgroundColor" => "#76BEC0"
                        ],
                        [
                            "key" => "netincome1",
                            "title" => "<div>股票面額 1元計</div><div>每股淨值 (元)</div>",
                            "label" => "股票面額 1元計每股淨值 (元)",
                            "type" => "line",
                            "yAxisID" => "y2",
                            "tension" => 0.55,
                            "pointBorderWidth" => 5,
                            "borderColor" => "#CDD55B",
                            "backgroundColor" => "#CDD55B"
                        ],
                        [
                            "key" => "currentratio",
                            "title" => "流動比率",
                            "label" => "流動比率",
                            "type" => "line",
                            "yAxisID" => "y2",
                            "tension" => 0.55,
                            "pointBorderWidth" => 5,
                            "borderColor" => "#76BEC0",
                            "backgroundColor" => "#76BEC0"
                        ],
                        [
                            "key" => "debtratio",
                            "title" => "負債比率",
                            "label" => "負債比率",
                            "type" => "line",
                            "yAxisID" => "y2",
                            "tension" => 0.55,
                            "pointBorderWidth" => 5,
                            "borderColor" => "#CDD55B",
                            "backgroundColor" => "#CDD55B"
                        ]
                    ]
                ],
                "year" => [
                    [
                        "cash" => "3050",
                        "receiveable" => "3333",
                        "currentassets" => "8573",
                        "equityinvestments" => "2779",
                        "currentliabilities" => "5063",
                        "noncurrentliabilities" => "2698",
                        "totalequity" => "8156",
                        "totalassets" => "15917",
                        "netincome10" => "86.24",
                        "netincome1" => "8.62",
                        "currentratio" => "169%",
                        "debtratio" => "49%"
                    ],
                    [
                        "cash" => "3,820",
                        "receiveable" => "3,489",
                        "currentassets" => "10,022",
                        "equityinvestments" => "2,913",
                        "currentliabilities" => "5,884",
                        "noncurrentliabilities" => "4,085",
                        "totalequity" => "8,047",
                        "totalassets" => "18,015",
                        "netincome10" => "87.52",
                        "netincome1" => "8.75",
                        "currentratio" => "184%",
                        "debtratio" => "46%"
                    ],
                    [
                        "cash" => "3,196",
                        "receiveable" => "3,646",
                        "currentassets" => "11,118",
                        "equityinvestments" => "3,088",
                        "currentliabilities" => "6,282",
                        "noncurrentliabilities" => "8,122",
                        "totalequity" => "8,916",
                        "totalassets" => "23,320",
                        "netincome10" => "101.71",
                        "netincome1" => "10.17",
                        "currentratio" => "177%",
                        "debtratio" => "62%"
                    ],
                    [
                        "cash" => "4,799",
                        "receiveable" => "4,775",
                        "currentassets" => "14,719",
                        "equityinvestments" => "3,436",
                        "currentliabilities" => "8,323",
                        "noncurrentliabilities" => "7,265",
                        "totalequity" => "14,721",
                        "totalassets" => "30,309",
                        "netincome10" => "158.03",
                        "netincome1" => "15.80",
                        "currentratio" => "177%",
                        "debtratio" => "51%"
                    ],
                    [
                        "cash" => "7,106",
                        "receiveable" => "3,894",
                        "currentassets" => "15,826",
                        "equityinvestments" => "3,099",
                        "currentliabilities" => "9,300",
                        "noncurrentliabilities" => "7,434",
                        "totalequity" => "16,387",
                        "totalassets" => "33,121",
                        "netincome10" => "167.99",
                        "netincome1" => "16.80",
                        "currentratio" => "170%",
                        "debtratio" => "51%"
                    ]
                ]
            ],

            "cash_flow" => [
                "unit" => [
                    "百萬新台幣"
                ],
                "scales" => [
                    "year" => [
                        "x" => [
                            "ticks" => [
                                "color" => "#000000",
                                "padding" => 9,
                                "font" => [
                                    "family" => "'Roboto'",
                                    "weight" => 600,
                                    "size" => 18
                                ]
                            ],
                            "stacked" => true,
                            "grid" => [
                                "color" => "#f2f1f1"
                            ]
                        ],
                        "y" => [
                            "beginAtZero" => true,
                            "ticks" => [
                                "padding" => 30,
                                "color" => "#B2B2B2",
                                "font" => [
                                    "family" => "'Roboto'",
                                    "weight" => 500,
                                    "size" => 14
                                ]
                            ],
                            "stacked" => true,
                            "grid" => [
                                "color" => "#f2f1f1"
                            ]
                        ]
                    ]
                ],
                "title" => [
                    "year" => [
                        [
                            "key" => "operate",
                            "title" => "營業活動現金流",
                            "label" => "營業活動現金流",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 160,
                            "borderRadius" => 4,
                            "backgroundColor" => "#6BABE0"
                        ],
                        [
                            "key" => "invest",
                            "title" => "投資活動現金流",
                            "label" => "投資活動現金流",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 160,
                            "borderRadius" => 4,
                            "backgroundColor" => "#91CBE8"
                        ],
                        [
                            "key" => "fund",
                            "title" => "籌資活動現金流",
                            "label" => "籌資活動現金流",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 160,
                            "borderRadius" => 4,
                            "backgroundColor" => "#A5A5A5"
                        ]
                    ]
                ],
                "year" => [
                    [
                        "operate" => "-39,341",
                        "invest" => "-64,990",
                        "fund" => "146,239"
                    ],
                    [
                        "operate" => "-40,156",
                        "invest" => "71,431",
                        "fund" => "118,970"
                    ],
                    [
                        "operate" => "248,018",
                        "invest" => "70,584",
                        "fund" => "-218,095"
                    ],
                    [
                        "operate" => "377,624",
                        "invest" => "34,586",
                        "fund" => "-25,118"
                    ],
                    [
                        "operate" => "-98,212",
                        "invest" => "-92,083",
                        "fund" => "24,281"
                    ]
                ]
            ],

            "share_data" => [
                "unit" => [
                    "新台幣元",
                    "新台幣元"
                ],
                "scales" => [
                    "year" => [
                        "x" => [
                            "ticks" => [
                                "color" => "#000000",
                                "padding" => 9,
                                "font" => [
                                    "family" => "'Roboto'",
                                    "weight" => 600,
                                    "size" => 18
                                ]
                            ],
                            "grid" => [
                                "color" => "#f2f1f1"
                            ]
                        ],
                        "y" => [
                            "beginAtZero" => true,
                            "ticks" => [
                                "padding" => 30,
                                "color" => "#B2B2B2",
                                "font" => [
                                    "family" => "'Roboto'",
                                    "weight" => 500,
                                    "size" => 14
                                ]
                            ],
                            "grid" => [
                                "color" => "#f2f1f1"
                            ]
                        ],
                        "y2" => [
                            "beginAtZero" => true,
                            "position" => "right",
                            "ticks" => [
                                "padding" => 30,
                                "color" => "#B2B2B2",
                                "font" => [
                                    "family" => "'Roboto'",
                                    "weight" => 500,
                                    "size" => 14
                                ]
                            ],
                            "grid" => [
                                "color" => "#f2f1f1"
                            ]
                        ]
                    ]
                ],
                "title" => [
                    "year" => [
                        [
                            "key" => "cash",
                            "title" => "現金股利",
                            "label" => "現金股利",
                            "type" => "bar",
                            "yAxisID" => "y2",
                            "maxBarThickness" => 160,
                            "borderRadius" => 4,
                            "backgroundColor" => "#D65C5C"
                        ],
                        [
                            "key" => "netrevenue",
                            "title" => "每股淨資產",
                            "label" => "每股淨資產",
                            "type" => "line",
                            "yAxisID" => "y",
                            "tension" => 0.55,
                            "pointBorderWidth" => 5,
                            "borderColor" => "#76BEC0",
                            "backgroundColor" => "#76BEC0"
                        ],
                        [
                            "key" => "eps",
                            "title" => "EPS",
                            "label" => "EPS",
                            "type" => "bar",
                            "yAxisID" => "y2",
                            "maxBarThickness" => 160,
                            "borderRadius" => 4,
                            "backgroundColor" => "#6BA2D0"
                        ]
                    ]
                ],
                "year" => [
                    [
                        "cash" => "2",
                        "netrevenue" => "68",
                        "eps" => "8.01"
                    ],
                    [
                        "cash" => "4",
                        "netrevenue" => "96",
                        "eps" => "8.03"
                    ],
                    [
                        "cash" => "4.2",
                        "netrevenue" => "101",
                        "eps" => "8.32"
                    ],
                    [
                        "cash" => "4",
                        "netrevenue" => "106",
                        "eps" => "7.34"
                    ],
                    [
                        "cash" => "5.2",
                        "netrevenue" => "113",
                        "eps" => "10.05"
                    ]
                ]
            ],

            "important_ratio" => [
                "unit" => [
                    "百分比",
                    "百分比"
                ],
                "scales" => [
                    "year" => [
                        "x" => [
                            "ticks" => [
                                "color" => "#000000",
                                "padding" => 9,
                                "font" => [
                                    "family" => "'Roboto'",
                                    "weight" => 600,
                                    "size" => 18
                                ]
                            ],
                            "grid" => [
                                "color" => "#f2f1f1"
                            ]
                        ],
                        "y" => [
                            "beginAtZero" => true,
                            "ticks" => [
                                "padding" => 30,
                                "color" => "#B2B2B2",
                                "font" => [
                                    "family" => "'Roboto'",
                                    "weight" => 500,
                                    "size" => 14
                                ]
                            ],
                            "grid" => [
                                "color" => "#f2f1f1"
                            ]
                        ],
                        "y2" => [
                            "beginAtZero" => true,
                            "position" => "right",
                            "ticks" => [
                                "padding" => 30,
                                "color" => "#B2B2B2",
                                "font" => [
                                    "family" => "'Roboto'",
                                    "weight" => 500,
                                    "size" => 14
                                ]
                            ],
                            "grid" => [
                                "color" => "#f2f1f1"
                            ]
                        ]
                    ]
                ],
                "title" => [
                    "year" => [
                        [
                            "key" => "EBITDA",
                            "title" => "EBITDA",
                            "label" => "EBITDA",
                            "type" => "line",
                            "yAxisID" => "y",
                            "pointBorderWidth" => 5,
                            "borderColor" => "#005EAD",
                            "backgroundColor" => "#005EAD"
                        ],
                        [
                            "key" => "ROA",
                            "title" => "ROA",
                            "label" => "ROA",
                            "type" => "line",
                            "yAxisID" => "y2",
                            "pointBorderWidth" => 5,
                            "borderColor" => "#76BEC0",
                            "backgroundColor" => "#76BEC0"
                        ],
                        [
                            "key" => "ROE",
                            "title" => "ROE",
                            "label" => "ROE",
                            "type" => "line",
                            "yAxisID" => "y2",
                            "pointBorderWidth" => 5,
                            "borderColor" => "#CDD55B",
                            "backgroundColor" => "#CDD55B"
                        ]
                    ]
                ],
                "year" => [
                    "20Q4" => [
                        "EBITDA" => "13%",
                        "ROA" => "1.24%",
                        "ROE" => "3.32%"
                    ],
                    "21Q1" => [
                        "EBITDA" => "13%",
                        "ROA" => "1.41%",
                        "ROE" => "3.63%"
                    ],
                    "21Q2" => [
                        "EBITDA" => "16%",
                        "ROA" => "1.83%",
                        "ROE" => "4.62%"
                    ],
                    "21Q3" => [
                        "EBITDA" => "24%",
                        "ROA" => "3.6%",
                        "ROE" => "8.85%"
                    ],
                    "21Q4" => [
                        "EBITDA" => "19%",
                        "ROA" => "2.4%",
                        "ROE" => "5.44%"
                    ],
                    "22Q1" => [
                        "EBITDA" => "24%",
                        "ROA" => "2.97%",
                        "ROE" => "6.23%"
                    ],
                    "22Q2" => [
                        "EBITDA" => "24%",
                        "ROA" => "2.90%",
                        "ROE" => "6.08%"
                    ],
                    "22Q3" => [
                        "EBITDA" => "32%",
                        "ROA" => "3.92%",
                        "ROE" => "7.95%"
                    ]
                ]
            ],

            "products_proportion" => [
                "unit" => [
                    "百分比"
                ],
                "scales" => [
                    "year" => [
                        "x" => [
                            "ticks" => [
                                "color" => "#000000",
                                "padding" => 9,
                                "font" => [
                                    "family" => "'Roboto'",
                                    "weight" => 600,
                                    "size" => 18
                                ]
                            ],
                            "stacked" => true,
                            "grid" => [
                                "color" => "#f2f1f1"
                            ]
                        ],
                        "y" => [
                            "beginAtZero" => true,
                            "ticks" => [
                                "padding" => 30,
                                "color" => "#B2B2B2",
                                "font" => [
                                    "family" => "'Roboto'",
                                    "weight" => 500,
                                    "size" => 14
                                ]
                            ],
                            "stacked" => true,
                            "grid" => [
                                "color" => "#f2f1f1"
                            ]
                        ]
                    ]
                ],
                "title" => [
                    "year" => [
                        [
                            "key" => "iclf",
                            "title" => "IC L/F",
                            "label" => "IC L/F",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 160,
                            "borderRadius" => 4,
                            "backgroundColor" => "#6BA2D0"
                        ],
                        [
                            "key" => "resin",
                            "title" => "封裝樹脂",
                            "label" => "封裝樹脂",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 160,
                            "borderRadius" => 4,
                            "backgroundColor" => "#D65C5C"
                        ],
                        [
                            "key" => "other",
                            "title" => "其他(含基板)",
                            "label" => "其他(含基板)",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 160,
                            "borderRadius" => 4,
                            "backgroundColor" => "#A5A5A5"
                        ],
                        [
                            "key" => "ledlf",
                            "title" => "LED L/F",
                            "label" => "LED L/F",
                            "type" => "bar",
                            "yAxisID" => "y",
                            "maxBarThickness" => 160,
                            "borderRadius" => 4,
                            "backgroundColor" => "#C29772"
                        ]
                    ]
                ],
                "year" => [
                    "20Q4" => [
                        "iclf" => "47%",
                        "resin" => "28%",
                        "other" => "21%",
                        "ledlf" => "4%"
                    ],
                    "21Q1" => [
                        "iclf" => "47%",
                        "resin" => "29%",
                        "other" => "20%",
                        "ledlf" => "4%"
                    ],
                    "21Q2" => [
                        "iclf" => "49%",
                        "resin" => "28%",
                        "other" => "17%",
                        "ledlf" => "6%"
                    ],
                    "21Q3" => [
                        "iclf" => "51%",
                        "resin" => "27%",
                        "other" => "17%",
                        "ledlf" => "5%"
                    ],
                    "21Q4" => [
                        "iclf" => "54%",
                        "resin" => "25%",
                        "other" => "17%",
                        "ledlf" => "4%"
                    ],
                    "22Q1" => [
                        "iclf" => "55%",
                        "resin" => "25%",
                        "other" => "17%",
                        "ledlf" => "3%"
                    ],
                    "22Q2" => [
                        "iclf" => "55%",
                        "resin" => "25%",
                        "other" => "18%",
                        "ledlf" => "3%"
                    ],
                    "22Q3" => [
                        "iclf" => "59%",
                        "resin" => "22%",
                        "other" => "16%",
                        "ledlf" => "3%"
                    ]
                ]
            ]

        ];
    }

    /**
     * @param  Request $request
     * @param  InboxReceivedRepository $repository
     * @return \Illuminate\Http\Response
     * @throws  \Exception
     */
    public function financialData(Request $request)
    {

        $headers = array(
            'Content-Type' => 'application/json; charset=utf-8'
        );

        //dump($this->defaultArr);exit;
        $categoryId = 'web-block-investor-income-statement';

        $articleCategory = ArticleCategory::query()
            ->with(['articleCategories.articleCategories'])
            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->where('id',$categoryId)->distributedOrWhere('code',$categoryId)
            ->distributedActive()
            ->orderBy('sort')
            ->first();


        $articleBlocks = ArticleBlock::query()
            ->with([
                'articleCategories.articleCategory',
            ])
            ->whereHas('languageUsage', function ($query) {
                $query->whereJsonContains('languages', [app()->getLocale() => true]);
            })
            ->whereHas('articleCategories', function ($query) use($articleCategory) {
                $query->where('id', array_get($articleCategory,'id'));
            })

            ->where(function ($query) {
                $query->distributedWhereNull('start_at')->distributedOrWhere('start_at', '<=', now());
            })
            ->where(function ($query) {
                $query->distributedWhereNull('end_at')->distributedOrWhere('end_at', '>=', now());
            })
            ->distributedActive()->get();


        $year = array();
        $quarter = array();

        foreach($articleBlocks ?? [] as $key => $item){
            $array = array_only($item->toArray(),['income','grossprofit','revenue','netincome','cpynetincome','eps10','eps1']);
            $quarter[array_get($item,'title')] = $array;

            if(is_numeric(mb_substr(array_get($item,'title'),0,2))){
                try {
                    foreach($array as $key2 => $value){
                        if(!empty($year['20' . mb_substr(array_get($item, 'title'), 0, 2)][$key2])) {
                            $year['20' . mb_substr(array_get($item, 'title'), 0, 2)][$key2] += $value;
                        }else{
                            $year['20' . mb_substr(array_get($item, 'title'), 0, 2)][$key2] = $value;
                        }
                    }
                }catch (\Exception $e){}
            }
        }


        foreach($year as $key => $item){
            foreach($item as $key2 => $value2){
                if(is_numeric($value2)) {
                    $year[$key][$key2] = number_format($value2);
                }
            }
        }

        foreach($quarter as $key => $item){
            foreach($item as $key2 => $value2){
                if(is_numeric($value2)) {
                    $quarter[$key][$key2] = number_format($value2);
                }
            }
        }

        $arr = [
            'year' => $year,
            'quarter' => $quarter,
        ];


        $income_statement = array_merge(array_get($this->defaultArr,'income_statement'),$arr);
        $addArr = ['income_statement' => $income_statement];

        $this->defaultArr = array_merge($this->defaultArr,$addArr);

        return response()->json($this->defaultArr,200,$headers,JSON_UNESCAPED_UNICODE);


    }






}
