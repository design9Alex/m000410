"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[1467],{2583:(t,e,a)=>{a.d(e,{Z:()=>l});var s=a(4015),n=a.n(s),i=a(3645),r=a.n(i)()(n());r.push([t.id,"#age-source-serial[data-v-6878c0be]{height:265px}","",{version:3,sources:["webpack://./resources/js/admin/Components/PageSite/AgeSource.vue"],names:[],mappings:"AA2FA,oCACA,YACA",sourcesContent:['<template>\n  <section class="panel h-100-c">\n    <header class="panel-heading">\n      <h2 class="h5 float-left">{{ array_get(trans, \'module.age_source\') }}</h2>\n    </header>\n    <div class="panel-wrapper"></div>\n    <div class="panel-body pb-3">\n      <div id="age-source-serial"></div>\n    </div>\n  </section>\n</template>\n\n<script>\nimport \'amcharts3\';\nimport \'amcharts3/amcharts/serial\';\nimport \'amcharts3/amcharts/themes/light\';\n\nexport default {\n  name: "AgeSource",\n  props: {\n    \'urls\': Object,\n    \'trans\': Object,\n    \'days\': {\n      type: Number,\n      default: 30\n    }\n  },\n  data() {\n    return {\n      serialChart: null,\n      ageSource: []\n    }\n  },\n  mounted: function () {\n    this.createAmSerial();\n  },\n  watch: {\n    ageSource: function (afterVal, beforeVal) {\n      if (JSON.stringify(afterVal) !== JSON.stringify(beforeVal)) {\n        this.serialChart.dataProvider = afterVal;\n        this.$nextTick(() => {\n          this.serialChart.validateData();\n          this.serialChart.animateAgain();\n        });\n      }\n    }\n  },\n  methods: {\n    createAmSerial: function () {\n      this.serialChart = AmCharts.makeChart("age-source-serial", {\n        "hideCredits":true,\n        "type": "serial",\n        "theme": "light",\n        "dataProvider": this.ageSource,\n        "valueAxes": [{"gridColor": "#878787", "gridAlpha": 0.2, "dashLength": 0, "color": "#878787"}],\n        "gridAboveGraphs": true,\n        "startDuration": 1,\n        "graphs": [{\n          "balloonText": "[[category]]: <b>[[value]]</b>",\n          "fillAlphas": 0.8,\n          "lineAlpha": 0.2,\n          "type": "column",\n          "valueField": "visits",\n          "color": "#878787"\n        }],\n        "chartCursor": {"categoryBalloonEnabled": false, "cursorAlpha": 0, "zoomable": false},\n        "categoryField": "age",\n        "categoryAxis": {\n          "gridPosition": "start",\n          "gridAlpha": 0,\n          "tickPosition": "start",\n          "tickLength": 20,\n          "color": "#878787"\n        },\n        "export": {"enabled": false}\n      });\n      this.updateAgeSource();\n    },\n    updateAgeSource: function () {\n      if (this.filled(this.urls.age_source)) {\n        axios.get(this.urls.age_source + \'?days=\' + this.days)\n          .then((response) => {\n            this.ageSource = response.data;\n          });\n      }\n    }\n  }\n}\n<\/script>\n\n<style scoped>\n#age-source-serial {\n  height: 265px;\n}\n</style>\n'],sourceRoot:""}]);const l=r},4499:(t,e,a)=>{a.d(e,{Z:()=>l});var s=a(4015),n=a.n(s),i=a(3645),r=a.n(i)()(n());r.push([t.id,"#visited-source-pie[data-v-13b64319]{height:195px;width:100%}.visited-source-item[data-v-13b64319]{height:30px;width:100%}","",{version:3,sources:["webpack://./resources/js/admin/Components/PageSite/VisitedSource.vue"],names:[],mappings:"AAyKA,qCAEA,YAAA,CADA,UAEA,CACA,sCAEA,WAAA,CADA,UAEA",sourcesContent:['<template>\n  <section class="panel h-100-c">\n    <header class="panel-heading">\n      <h2 class="h5 float-left">{{ array_get(trans, \'module.source_from\') }}</h2>\n    </header>\n    <div class="panel-body">\n      <div id="visited-source-pie"></div>\n\n      <template v-for="(row, index) in lineSource">\n        <div class="row pl-3 pr-1" :class="{\'pb-2\': parseInt(index) === (lineSource.length - 1)}">\n          <div class="col-sm-8 col-xs-12">\n            <span class="badge float-left clabels d-inline mt-1 mr-3 no-radius" :class="getBadgeClass(index)"></span>\n            <div class="clabels-text d-inline txt-dark text-capitalize float-left">\n              <span class="d-block font-weight-bold mb-1">{{ row.rate }}%  {{ row.source }}</span>\x3c!--\n              --\x3e<span class="d-block text-muted small">{{ row.count }} {{ array_get(trans, \'module.visits\') }}</span>\n            </div>\n          </div>\n          <div class="col-sm-4 col-xs-12">\n            <div class="float-right mb-1 visited-source-item" :id="\'visited-source-item-\' + index"></div>\n          </div>\n        </div>\n        <hr class="my-2 w-100" v-if="parseInt(index) < (lineSource.length - 1)" />\n      </template>\n    </div>\n  </section>\n</template>\n\n<script>\nimport \'amcharts3\';\nimport \'amcharts3/amcharts/serial\';\nimport \'amcharts3/amcharts/pie\';\nimport \'amcharts3/amcharts/themes/light\';\n\nexport default {\n  name: "VisitedSource",\n  props: {\n    \'urls\': Object,\n    \'trans\': Object,\n    \'days\': {\n      type: Number,\n      default: 30\n    }\n  },\n  data() {\n    return {\n      pieChart: null,\n      pieSource: [],\n      lineCharts: [],\n      lineSource: [],\n    }\n  },\n  mounted: function () {\n    this.createAmPie();\n    this.updateLineSource();\n  },\n  watch: {\n    pieSource: function (afterVal, beforeVal) {\n      if (JSON.stringify(afterVal) !== JSON.stringify(beforeVal)) {\n        this.pieChart.dataProvider = afterVal;\n        this.$nextTick(() => {\n          this.pieChart.validateData();\n          this.pieChart.animateAgain();\n        });\n      }\n    },\n    lineSource: function (afterVal, beforeVal) {\n      if (JSON.stringify(afterVal) !== JSON.stringify(beforeVal)) {\n        for (let i in this.lineCharts) {\n          if (this.lineCharts.hasOwnProperty(i)) {\n            this.lineCharts[i].clear();\n          }\n        }\n        this.lineCharts = [];\n        this.$nextTick(() => {\n          for (let index in afterVal) {\n            this.createAmLine(index);\n          }\n        });\n      }\n    }\n  },\n  methods: {\n    createAmPie: function () {\n      this.pieChart = AmCharts.makeChart(\'visited-source-pie\', {\n        "hideCredits":true,\n        "type": "pie",\n        "theme": "light",\n        "dataProvider": this.pieSource,\n        "titleField": "source",\n        "valueField": "count",\n        "balloonText": "[[title]]<br><span style=\'font-size:14px\'><b>[[value]]</b> ([[percents]]%)</span>",\n        "innerRadius": "0",\n        "labelRadius": 5,\n        "radius": "45%",\n        "labelText": "",\n      });\n      this.updatePieSource();\n    },\n    updatePieSource: function () {\n      if (this.filled(this.urls.visited_source)) {\n        axios.get(this.urls.visited_source + \'?days=\' + this.days)\n          .then((response) => {\n            this.pieSource = response.data;\n          });\n      }\n    },\n    updateLineSource: function () {\n      if (this.filled(this.urls.visited_source_list)) {\n        axios.get(this.urls.visited_source_list + \'?days=\' + this.days)\n          .then((response) => {\n            this.lineSource = response.data;\n          });\n      }\n    },\n    createAmLine: function (index) {\n      this.lineCharts.push(AmCharts.makeChart(\'visited-source-item-\' + index, {\n        "hideCredits":true,\n        "type": "serial",\n        "theme": "light",\n        "dataProvider": this.lineSource[index].week,\n        "valueAxes": [\n          {"id": "v1", "axisAlpha": 0, "gridAlpha": 0, "zeroGridAlpha": 0}\n        ],\n        "categoryAxis": {"dashLength": 0, "gridAlpha": 0, "axisAlpha": 0},\n        "balloon": {"shadowAlpha": 0},\n        "marginTop": 0,\n        "marginRight": 0,\n        "marginLeft": 0,\n        "marginBottom": 0,\n        "autoMargins": false,\n        "startDuration": 1,\n        "graphs": [{\n          "id": "g1",\n          "balloon": {"drop": false, "adjustBorderColor": false, "color": "#ffffff"},\n          "fillAlphas": 0.2,\n          "bullet": "round",\n          "bulletBorderAlpha": 1,\n          "bulletColor": "#FFFFFF",\n          "hideBulletsCount": 5,\n          "lineThickness": 1,\n          "valueField": "value"\n        }],\n        "chartCursor": {\n          "valueLineEnabled": false,\n          "categoryBalloonEnabled": false,\n          "cursorColor": "#67b7dc",\n          "pan": true\n        },\n        "categoryField": "date",\n        "export": {"enabled": false},\n      }));\n    },\n    getBadgeClass: function (index) {\n      switch (parseInt(index)) {\n        case 0:\n          return [\'badge-info\'];\n        case 1:\n          return [\'badge-warning\'];\n        case 2:\n          return [\'badge-success\'];\n        default:\n          return [];\n      }\n    }\n  }\n}\n<\/script>\n\n<style scoped>\n#visited-source-pie {\n  width: 100%;\n  height: 195px;\n}\n.visited-source-item {\n  width: 100%;\n  height: 30px;\n}\n</style>\n'],sourceRoot:""}]);const l=r},3852:(t,e,a)=>{a.d(e,{Z:()=>l});var s=a(4015),n=a.n(s),i=a(3645),r=a.n(i)()(n());r.push([t.id,"#world-source-map[data-v-5d4a3c7e]{height:440px;width:100%}","",{version:3,sources:["webpack://./resources/js/admin/Components/PageSite/WorldSource.vue"],names:[],mappings:"AAyEA,mCAEA,YAAA,CADA,UAEA",sourcesContent:["<template>\n  <section class=\"panel h-100-c\">\n    <div id=\"world-source-map\"></div>\n  </section>\n</template>\n\n<script>\nimport 'amcharts3';\nimport 'amcharts3/amcharts/themes/light';\nimport 'ammap3';\nimport 'ammap3/ammap/maps/js/worldLow';\n\nexport default {\n  name: \"WorldSource\",\n  props: {\n    'urls': Object,\n    'trans': Object,\n    'days': {\n      type: Number,\n      default: 30\n    }\n  },\n  data() {\n    return {\n      mapChart: null,\n      mapSource: []\n    }\n  },\n  mounted: function () {\n    this.updateMapSource();\n  },\n  methods: {\n    createAmMap: function () {\n      this.mapChart = new AmCharts.AmMap();\n      this.mapChart.addTitle(this.array_get(this.trans, 'module.source_country'), 14);\n      this.mapChart.hideCredits = true;\n      this.mapChart.projection = \"winkel3\";\n      this.mapChart.areasSettings = {unlistedAreasColor: \"#000000\", unlistedAreasAlpha: 0.1};\n      this.mapChart.imagesSettings = {\n        balloonText: \"<span style='font-size:14px;'><b>[[title]]</b>: [[value]]</span>\",\n        alpha: 0.6\n      };\n      this.mapChart.dataProvider = {mapVar: AmCharts.maps.worldLow, images: []};\n      if (this.mapSource.length > 0) {\n        for (let index in this.mapSource) {\n          this.mapChart.dataProvider.images.push({\n            type: \"circle\", width: 10, height: 10,\n            color: this.mapSource[index].color,\n            longitude: this.mapSource[index].longitude,\n            latitude: this.mapSource[index].latitude,\n            title: this.mapSource[index].name,\n            value: this.mapSource[index].value\n          });\n        }\n      }\n      this.mapChart.write(\"world-source-map\");\n    },\n    updateMapSource: function () {\n      if (this.filled(this.urls.world_source)) {\n        axios.get(this.urls.world_source + '?days=' + this.days)\n          .then((response) => {\n            this.mapSource = response.data;\n            this.$nextTick(() => {\n              this.createAmMap();\n            });\n          });\n      }\n    }\n  }\n}\n<\/script>\n\n<style scoped>\n#world-source-map {\n  width: 100%;\n  height: 440px;\n}\n</style>\n"],sourceRoot:""}]);const l=r},3812:(t,e,a)=>{a.d(e,{Z:()=>n});const s={name:"SiteBreadcrumbs",props:{breadcrumbs:Array}};const n=(0,a(1900).Z)(s,(function(){var t=this,e=t._self._c;return t.filled(t.breadcrumbs)?e("div",{staticClass:"row justify-content-between"},[e("div",{staticClass:"col-auto"},[e("nav",{staticClass:"ml-2 mt-1",attrs:{"aria-label":"breadcrumb"}},[e("ol",{staticClass:"breadcrumb"},t._l(t.breadcrumbs,(function(a,s){return e("li",{staticClass:"breadcrumb-item",class:{active:s===t.breadcrumbs.length-1}},[t.filled(a.url)?e("a",{attrs:{href:a.url}},[0===s?e("i",{staticClass:"icon-home3 mr-2"}):t._e(),e("span",[t._v(t._s(a.title))])]):[0===s?e("i",{staticClass:"icon-home3 mr-2"}):t._e(),e("span",{class:{"text-muted":s<t.breadcrumbs.length-1}},[t._v(t._s(a.title))])]],2)})),0)])])]):t._e()}),[],!1,null,null,null).exports},6102:(t,e,a)=>{a.d(e,{Z:()=>n});const s={name:"SiteFooter",props:{footerUrl:String},data:function(){return{year:null,author:null,designer:null,link:null}},mounted:function(){var t=this;axios.get(this.footerUrl).then((function(e){t.year=e.data.data.year,t.author=e.data.data.author,t.designer=e.data.data.designer,t.link=e.data.data.link}))}};const n=(0,a(1900).Z)(s,(function(){var t=this,e=t._self._c;return e("footer",{staticClass:"page-footer small p-2"},[t.filled(t.author)?e("p",{staticClass:"mb-0"},[t._v("\n    "+t._s(t.year)+" © "+t._s(t.author)+".\n    Design By "),t.blank(t.link)?e("span",[t._v(t._s(t.designer))]):e("a",{attrs:{href:t.link,target:"_blank"}},[t._v(t._s(t.designer))])]):t._e()])}),[],!1,null,null,null).exports},5482:(t,e,a)=>{a.d(e,{Z:()=>i});var s=a(2300);const n={name:"SiteHeader",props:{headerUrl:String,menuActive:Boolean,trans:Object},data:function(){return{siteTitle:"",systemUrl:"",systemLogo:"",profileUrl:"",logoutUrl:"",layoutLanguages:[],layoutLanguage:document.documentElement.lang}},mounted:function(){var t=this;axios.get(this.headerUrl+"?current="+s.DS.encode(window.location.href)).then((function(e){t.siteTitle=e.data.data.siteTitle,t.systemUrl=e.data.data.systemUrl,t.systemLogo=e.data.data.systemLogo,t.profileUrl=e.data.data.profileUrl,t.logoutUrl=e.data.data.logoutUrl,t.layoutLanguages=e.data.data.layoutLanguages}))}};const i=(0,a(1900).Z)(n,(function(){var t=this,e=t._self._c;return e("div",{staticClass:"page-header fixed-top"},[e("h1",{staticClass:"navbar-brand left-width pl-3 navbar navbar-expand-lg"},[e("a",{staticClass:"font-weight-bold text-uppercase",attrs:{href:t.systemUrl}},[e("img",{staticClass:"mr-1 align-middle",attrs:{src:t.systemLogo,alt:""}})])]),t._v(" "),e("button",{staticClass:"btn btn-link toggle-left-nav-btn no-decoration",attrs:{type:"button"},on:{click:function(e){return t.$emit("toggle-menu",!t.menuActive)}}},[e("span",{staticClass:"text-hide"},[t._v(t._s(t.array_get(t.trans,"ui.layout.menu")))]),e("span",{staticClass:"line"})]),t._v(" "),e("div",{staticClass:"top-right pr-2 mt-1"},[t.layoutLanguages.length>1?e("div",{staticClass:"d-inline-block dropdown globe"},[e("button",{staticClass:"btn btn-link text-secondary dropdown-toggle px-2",attrs:{id:"menu-globe",type:"button","data-toggle":"dropdown","aria-haspopup":"true","aria-expanded":"false"}},[e("i",{staticClass:"icon-globe h4"}),e("span",{staticClass:"text-hide"},[t._v(t._s(t.array_get(t.trans,"ui.layout.language")))])]),t._v(" "),e("div",{staticClass:"dropdown-menu dropdown-menu-right rounded-0",attrs:{"aria-labelledby":"menu-globe"}},t._l(t.layoutLanguages,(function(a){return e("a",{staticClass:"dropdown-item",class:{active:a.id===t.layoutLanguage},attrs:{href:a.id===t.layoutLanguage?"#":a.url}},[e("i",{staticClass:"img-thumbnail flag flag-icon-background",class:[a.icon_class]}),e("span",[t._v(t._s(a.title))])])})),0)]):t._e(),t._v(" "),e("div",{staticClass:"d-inline-block dropdown globe"},[e("button",{staticClass:"btn btn-link text-secondary dropdown-toggle px-2",attrs:{id:"menu-profile",type:"button","data-toggle":"dropdown","aria-haspopup":"true","aria-expanded":"false"}},[e("i",{staticClass:"icon-user h4"}),e("span",{staticClass:"text-hide"},[t._v(t._s(t.array_get(t.trans,"ui.layout.account")))])]),t._v(" "),e("div",{staticClass:"dropdown-menu dropdown-menu-right rounded-0",attrs:{"aria-labelledby":"menu-profile"}},[e("a",{staticClass:"dropdown-item",attrs:{href:t.profileUrl}},[e("i",{staticClass:"icon-vcard"}),e("span",[t._v(t._s(t.array_get(t.trans,"ui.layout.profile")))])]),t._v(" "),e("a",{staticClass:"dropdown-item",attrs:{href:t.logoutUrl}},[e("i",{staticClass:"icon-log-out"}),e("span",[t._v(t._s(t.array_get(t.trans,"ui.layout.logout")))])])])])])])}),[],!1,null,null,null).exports},3343:(t,e,a)=>{a.d(e,{Z:()=>o});var s=a(5482),n=a(6102),i=a(2915),r=a(3812);const l={name:"SiteMain",components:{SiteHeader:s.Z,SiteFooter:n.Z,SiteMenu:i.Z,SiteBreadcrumbs:r.Z},props:{urls:Object,configs:Object,trans:Object,breadcrumbs:Array},data:function(){return{menuActive:!0,dataLanguage:"zh-TW",pageMinHeight:0,authTimer:null}},created:function(){this.menuActive=window.innerWidth>=this.minmaxConfig.mobileWidthX},mounted:function(){var t=this;window.addEventListener("resize",(function(){t.changePageSize(),t.changeMenuToggle()})),this.authTimer=setTimeout(this.validateAuth,3e5)},watch:{pageMinHeight:function(t){this.$emit("page-min-height-change",t)}},methods:{changePageSize:function(){var t=window.innerHeight,e=window.innerWidth;if(document.querySelector(".content-header")&&document.querySelector(".page-footer")&&document.querySelector(".page-header")){var a=document.querySelector(".content-header").offsetHeight,s=document.querySelector(".page-header").offsetHeight,n=t-a-s-35;this.pageMinHeight=e<576?n+s:n}else this.pageMinHeight=0},changeMenuToggle:function(){var t=this;window.innerWidth<this.minmaxConfig.mobileWidthX?this.menuActive&&setTimeout((function(){t.menuActive=!1}),200):this.menuActive||setTimeout((function(){t.menuActive=!0}),200)},validateAuth:function(){var t=this;this.array_get(this.urls,"validate_auth")&&axios.get(this.urls.validate_auth).then((function(e){"0000"===e.data.code&&(t.authTimer=setTimeout(t.validateAuth,3e5))})).catch((function(){}))}}};const o=(0,a(1900).Z)(l,(function(){var t=this,e=t._self._c;return e("div",{staticClass:"wrapper",class:{"slide-nav-close":!t.menuActive}},[e("site-header",{attrs:{"header-url":t.urls.api_header,"menu-active":t.menuActive,trans:t.trans},on:{"toggle-menu":function(e){t.menuActive=e}}}),t._v(" "),e("div",{staticClass:"border-box page-content"},[e("div",{staticClass:"content-header"},[e("site-breadcrumbs",{attrs:{breadcrumbs:t.breadcrumbs}})],1),t._v(" "),e("div",{staticClass:"content-body"},[t._t("default",null,{pageMinHeight:t.pageMinHeight})],2)]),t._v(" "),e("site-menu",{attrs:{"menu-url":t.urls.api_menu,"current-menu-id":t.configs.page_id},on:{"toggle-menu":function(e){t.menuActive=e}}}),t._v(" "),e("site-footer",{attrs:{"footer-url":t.urls.api_footer}})],1)}),[],!1,null,null,null).exports},2915:(t,e,a)=>{a.d(e,{Z:()=>r});function s(t,e){var a="undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(!a){if(Array.isArray(t)||(a=function(t,e){if(!t)return;if("string"==typeof t)return n(t,e);var a=Object.prototype.toString.call(t).slice(8,-1);"Object"===a&&t.constructor&&(a=t.constructor.name);if("Map"===a||"Set"===a)return Array.from(t);if("Arguments"===a||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(a))return n(t,e)}(t))||e&&t&&"number"==typeof t.length){a&&(t=a);var s=0,i=function(){};return{s:i,n:function(){return s>=t.length?{done:!0}:{done:!1,value:t[s++]}},e:function(t){throw t},f:i}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var r,l=!0,o=!1;return{s:function(){a=a.call(t)},n:function(){var t=a.next();return l=t.done,t},e:function(t){o=!0,r=t},f:function(){try{l||null==a.return||a.return()}finally{if(o)throw r}}}}function n(t,e){(null==e||e>t.length)&&(e=t.length);for(var a=0,s=new Array(e);a<e;a++)s[a]=t[a];return s}const i={name:"SiteMenu",props:["menuUrl","currentMenuId"],data:function(){return{menus:[]}},mounted:function(){var t=this;axios.get(this.menuUrl).then((function(e){t.menus=e.data.data}))},watch:{menus:function(){this.$nextTick((function(){$("#layout-menu-nicescroll").slimScroll({height:"100%",color:"#878787",disableFadeOut:!0,borderRadius:0,size:"4px",alwaysVisible:!1})}))}},methods:{isAvailable:function(t){if(this.filled(t.url))return!0;if(t.children.length>0){var e,a=s(t.children);try{for(a.s();!(e=a.n()).done;){var n=e.value;if(this.isAvailable(n))return!0}}catch(t){a.e(t)}finally{a.f()}}return!1},isActive:function(t){if(t.id===this.currentMenuId)return!0;var e,a=s(t.children);try{for(a.s();!(e=a.n()).done;){var n=e.value;if(this.isActive(n))return!0}}catch(t){a.e(t)}finally{a.f()}return!1},getUrl:function(t){return this.blank(t)?"javascript:void(0);":t}}};const r=(0,a(1900).Z)(i,(function(){var t=this,e=t._self._c;return e("nav",{staticClass:"fixed-sidebar-left left-width"},[e("ul",{staticClass:"side-nav",attrs:{id:"layout-menu-nicescroll"}},[t._l(t.menus,(function(a,s){return[t.isAvailable(a)&&0!==s?e("li",[e("hr",{staticClass:"mb-0"})]):t._e(),t._v(" "),t.isAvailable(a)?e("li",{staticClass:"navigation-header"},[e("span",[t._v(t._s(a.title))]),e("i",{staticClass:"icon-dots-three-horizontal"})]):t._e(),t._v(" "),t._l(a.children,(function(s){return t.isAvailable(a)?[t.isAvailable(s)&&t.blank(s.url)?e("li",[e("a",{staticClass:"collapsed",class:{active:t.isActive(s)},attrs:{href:"javascript:void(0);","data-toggle":"collapse","data-target":"#Menu_"+s.id},on:{click:function(e){return t.$emit("toggle-menu",!0)}}},[e("div",{staticClass:"float-left"},[t.filled(s.icon)?e("i",{class:s.icon}):t._e(),e("span",{staticClass:"right-nav-text"},[t._v(t._s(s.title))])]),t._v(" "),t._m(0,!0),t._v(" "),e("div",{staticClass:"clearfix"})]),t._v(" "),e("ul",{staticClass:"collapse collapse-level-1",class:{show:t.isActive(s)},attrs:{id:"Menu_"+s.id}},t._l(s.children,(function(a){return e("li",[e("a",{class:{active:t.isActive(a)},attrs:{href:t.getUrl(a.url),target:a.target}},[t._v(t._s(a.title))])])})),0)]):t.isAvailable(s)&&t.filled(s.url)?e("li",[e("a",{class:{active:t.isActive(s)},attrs:{href:t.getUrl(s.url),target:s.target}},[e("div",{staticClass:"float-left"},[t.filled(s.icon)?e("i",{class:s.icon}):t._e(),e("span",{staticClass:"right-nav-text"},[t._v(t._s(s.title))])]),t._v(" "),e("div",{staticClass:"clearfix"})])]):t._e()]:t._e()}))]}))],2)])}),[function(){var t=this._self._c;return t("div",{staticClass:"float-right"},[t("i",{staticClass:"icon-chevron-small-right"})])}],!1,null,null,null).exports},8660:(t,e,a)=>{a.r(e),a.d(e,{default:()=>T});var s=a(3343);const n={name:"SummaryBlock",props:{url:String,subject:{type:String,default:"-"},bgClass:{type:String,default:"bg-main"},iconClass:{type:String,default:"icon-database"}},data:function(){return{count:"-"}},mounted:function(){this.updateData()},methods:{updateData:function(){var t=this;this.filled(this.url)&&axios.get(this.url).then((function(e){t.count=e.data.total}))}}};var i=a(1900);const r=(0,i.Z)(n,(function(){var t=this,e=t._self._c;return e("section",{staticClass:"panel p-3 text-white",class:[t.bgClass]},[e("div",{staticClass:"row"},[e("div",{staticClass:"col"},[e("span",{staticClass:"d-block mb-1 h3"},[t._v(t._s(t.count))]),t._v(" "),e("span",{staticClass:"d-block"},[t._v(t._s(t.subject))])]),t._v(" "),e("div",{staticClass:"col"},[e("span",{staticClass:"display-4",class:[t.iconClass]})])])])}),[],!1,null,null,null).exports;a(4953),a(947),a(8928),a(2443);const l={name:"VisitedSource",props:{urls:Object,trans:Object,days:{type:Number,default:30}},data:function(){return{pieChart:null,pieSource:[],lineCharts:[],lineSource:[]}},mounted:function(){this.createAmPie(),this.updateLineSource()},watch:{pieSource:function(t,e){var a=this;JSON.stringify(t)!==JSON.stringify(e)&&(this.pieChart.dataProvider=t,this.$nextTick((function(){a.pieChart.validateData(),a.pieChart.animateAgain()})))},lineSource:function(t,e){var a=this;if(JSON.stringify(t)!==JSON.stringify(e)){for(var s in this.lineCharts)this.lineCharts.hasOwnProperty(s)&&this.lineCharts[s].clear();this.lineCharts=[],this.$nextTick((function(){for(var e in t)a.createAmLine(e)}))}}},methods:{createAmPie:function(){this.pieChart=AmCharts.makeChart("visited-source-pie",{hideCredits:!0,type:"pie",theme:"light",dataProvider:this.pieSource,titleField:"source",valueField:"count",balloonText:"[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",innerRadius:"0",labelRadius:5,radius:"45%",labelText:""}),this.updatePieSource()},updatePieSource:function(){var t=this;this.filled(this.urls.visited_source)&&axios.get(this.urls.visited_source+"?days="+this.days).then((function(e){t.pieSource=e.data}))},updateLineSource:function(){var t=this;this.filled(this.urls.visited_source_list)&&axios.get(this.urls.visited_source_list+"?days="+this.days).then((function(e){t.lineSource=e.data}))},createAmLine:function(t){this.lineCharts.push(AmCharts.makeChart("visited-source-item-"+t,{hideCredits:!0,type:"serial",theme:"light",dataProvider:this.lineSource[t].week,valueAxes:[{id:"v1",axisAlpha:0,gridAlpha:0,zeroGridAlpha:0}],categoryAxis:{dashLength:0,gridAlpha:0,axisAlpha:0},balloon:{shadowAlpha:0},marginTop:0,marginRight:0,marginLeft:0,marginBottom:0,autoMargins:!1,startDuration:1,graphs:[{id:"g1",balloon:{drop:!1,adjustBorderColor:!1,color:"#ffffff"},fillAlphas:.2,bullet:"round",bulletBorderAlpha:1,bulletColor:"#FFFFFF",hideBulletsCount:5,lineThickness:1,valueField:"value"}],chartCursor:{valueLineEnabled:!1,categoryBalloonEnabled:!1,cursorColor:"#67b7dc",pan:!0},categoryField:"date",export:{enabled:!1}}))},getBadgeClass:function(t){switch(parseInt(t)){case 0:return["badge-info"];case 1:return["badge-warning"];case 2:return["badge-success"];default:return[]}}}};var o=a(3379),c=a.n(o),u=a(4499),d={insert:"head",singleton:!1};c()(u.Z,d);u.Z.locals;const h=(0,i.Z)(l,(function(){var t=this,e=t._self._c;return e("section",{staticClass:"panel h-100-c"},[e("header",{staticClass:"panel-heading"},[e("h2",{staticClass:"h5 float-left"},[t._v(t._s(t.array_get(t.trans,"module.source_from")))])]),t._v(" "),e("div",{staticClass:"panel-body"},[e("div",{attrs:{id:"visited-source-pie"}}),t._v(" "),t._l(t.lineSource,(function(a,s){return[e("div",{staticClass:"row pl-3 pr-1",class:{"pb-2":parseInt(s)===t.lineSource.length-1}},[e("div",{staticClass:"col-sm-8 col-xs-12"},[e("span",{staticClass:"badge float-left clabels d-inline mt-1 mr-3 no-radius",class:t.getBadgeClass(s)}),t._v(" "),e("div",{staticClass:"clabels-text d-inline txt-dark text-capitalize float-left"},[e("span",{staticClass:"d-block font-weight-bold mb-1"},[t._v(t._s(a.rate)+"%  "+t._s(a.source))]),e("span",{staticClass:"d-block text-muted small"},[t._v(t._s(a.count)+" "+t._s(t.array_get(t.trans,"module.visits")))])])]),t._v(" "),e("div",{staticClass:"col-sm-4 col-xs-12"},[e("div",{staticClass:"float-right mb-1 visited-source-item",attrs:{id:"visited-source-item-"+s}})])]),t._v(" "),parseInt(s)<t.lineSource.length-1?e("hr",{staticClass:"my-2 w-100"}):t._e()]}))],2)])}),[],!1,null,"13b64319",null).exports;const p={name:"CurrentVisitor",props:{urls:Object,trans:Object,days:{type:Number,default:30},decimals:{type:Number,default:2}},data:function(){return{currentVisitor:"-",percentNewSessions:"0.00%",pageViewsPerSession:"-",avgTimeOnPage:"-",exitRate:"-"}},mounted:function(){this.updateData()},methods:{updateData:function(){var t=this;this.filled(this.urls.current_visitor)&&axios.get(this.urls.current_visitor+"?days="+this.days+"&decimals="+this.decimals).then((function(e){t.currentVisitor=e.data.currentVisitor,t.percentNewSessions=e.data.percentNewSessions,t.pageViewsPerSession=e.data.pageViewsPerSession,t.avgTimeOnPage=e.data.avgTimeOnPage,t.exitRate=e.data.exitRate}))}}};const m=(0,i.Z)(p,(function(){var t=this,e=t._self._c;return e("section",{staticClass:"panel h-45-c"},[e("header",{staticClass:"panel-heading text-center"},[e("h2",{staticClass:"h5 px-2 float-left"},[t._v(t._s(t.array_get(t.trans,"module.online_users")))])]),t._v(" "),e("div",{staticClass:"panel-body"},[e("div",{staticClass:"h3 text-center font-weight-bold pb-1"},[e("span",{staticClass:"text-main"},[t._v(t._s(t.currentVisitor))])]),t._v(" "),e("div",{staticClass:"progress",staticStyle:{height:"5px"},attrs:{title:t.percentNewSessions+t.array_get(t.trans,"module.new_session")}},[e("div",{staticClass:"progress-bar progress-bar-striped progress-bar-animated bg-main",style:{width:t.percentNewSessions},attrs:{role:"progressbar","aria-valuenow":t.percentNewSessions.substr(-1),"aria-valuemin":"0","aria-valuemax":"100"}})]),t._v(" "),e("div",{staticClass:"row text-center py-3"},[e("div",{staticClass:"col"},[e("span",{staticClass:"d-block text-muted small"},[t._v(t._s(t.array_get(t.trans,"module.session_page")))]),t._v(" "),e("span",{staticClass:"d-block font-weight-bold mb-1"},[t._v(t._s(t.pageViewsPerSession))])]),t._v(" "),e("div",{staticClass:"col"},[e("span",{staticClass:"d-block text-muted small"},[t._v(t._s(t.array_get(t.trans,"module.stay_time")))]),t._v(" "),e("span",{staticClass:"d-block font-weight-bold mb-1"},[t._v(t._s(t.avgTimeOnPage))])]),t._v(" "),e("div",{staticClass:"col"},[e("span",{staticClass:"d-block text-muted small"},[t._v(t._s(t.array_get(t.trans,"module.exit_rate")))]),t._v(" "),e("span",{staticClass:"d-block font-weight-bold mb-1"},[t._v(t._s(t.exitRate))])])])])])}),[],!1,null,null,null).exports;const g={name:"TopBrowsers",props:{urls:Object,trans:Object,days:{type:Number,default:30},max:{type:Number,default:4}},data:function(){return{browsers:[]}},mounted:function(){this.updateData()},methods:{updateData:function(){var t=this;this.filled(this.urls.top_browsers)&&axios.get(this.urls.top_browsers+"?days="+this.days+"&max="+this.max).then((function(e){t.browsers=e.data}))},getBadgeClass:function(t){switch(parseInt(t)){case 0:return["badge","badge-pill","badge-main"];case 1:return["badge","badge-pill","badge-warning"];case 2:return["badge","badge-pill","badge-info"];case 3:return["badge","badge-pill","badge-success"];default:return["badge","badge-pill"]}}}};const v=(0,i.Z)(g,(function(){var t=this,e=t._self._c;return e("section",{staticClass:"panel h-55-c"},[e("header",{staticClass:"panel-heading text-center"},[e("h2",{staticClass:"h5 float-left"},[t._v(t._s(t.array_get(t.trans,"module.browser_usage")))])]),t._v(" "),t._l(t.browsers,(function(a,s){return[e("div",{staticClass:"clearfix px-4",class:{"py-1":0!==parseInt(s),"pb-2":parseInt(s)===t.browsers.length-1}},[e("span",{staticClass:"flot-left small"},[t._v(t._s(a.browser))]),t._v(" "),e("span",{staticClass:"float-right"},[e("span",{class:t.getBadgeClass(s)},[t._v(t._s(a.rate))])])]),t._v(" "),parseInt(s)<t.browsers.length-1?e("hr",{staticClass:"my-2 w-100"}):t._e()]}))],2)}),[],!1,null,null,null).exports;a(138),a(4016);const f={name:"WorldSource",props:{urls:Object,trans:Object,days:{type:Number,default:30}},data:function(){return{mapChart:null,mapSource:[]}},mounted:function(){this.updateMapSource()},methods:{createAmMap:function(){if(this.mapChart=new AmCharts.AmMap,this.mapChart.addTitle(this.array_get(this.trans,"module.source_country"),14),this.mapChart.hideCredits=!0,this.mapChart.projection="winkel3",this.mapChart.areasSettings={unlistedAreasColor:"#000000",unlistedAreasAlpha:.1},this.mapChart.imagesSettings={balloonText:"<span style='font-size:14px;'><b>[[title]]</b>: [[value]]</span>",alpha:.6},this.mapChart.dataProvider={mapVar:AmCharts.maps.worldLow,images:[]},this.mapSource.length>0)for(var t in this.mapSource)this.mapChart.dataProvider.images.push({type:"circle",width:10,height:10,color:this.mapSource[t].color,longitude:this.mapSource[t].longitude,latitude:this.mapSource[t].latitude,title:this.mapSource[t].name,value:this.mapSource[t].value});this.mapChart.write("world-source-map")},updateMapSource:function(){var t=this;this.filled(this.urls.world_source)&&axios.get(this.urls.world_source+"?days="+this.days).then((function(e){t.mapSource=e.data,t.$nextTick((function(){t.createAmMap()}))}))}}};var b=a(3852),_={insert:"head",singleton:!1};c()(b.Z,_);b.Z.locals;const C=(0,i.Z)(f,(function(){this._self._c;return this._m(0)}),[function(){var t=this._self._c;return t("section",{staticClass:"panel h-100-c"},[t("div",{attrs:{id:"world-source-map"}})])}],!1,null,"5d4a3c7e",null).exports;const y={name:"PathViews",props:{urls:Object,trans:Object,days:{type:Number,default:30},max:{type:Number,default:5}},data:function(){return{pages:[]}},mounted:function(){this.updateData()},methods:{updateData:function(){var t=this;this.filled(this.urls.path_views)&&axios.get(this.urls.path_views+"?days="+this.days+"&max="+this.max).then((function(e){t.pages=e.data}))}}};const x=(0,i.Z)(y,(function(){var t=this,e=t._self._c;return e("section",{staticClass:"panel h-100-c"},[e("header",{staticClass:"panel-heading"},[e("h2",{staticClass:"h5 float-left"},[t._v(t._s(t.array_get(t.trans,"module.hot_page")))])]),t._v(" "),e("div",{staticClass:"panel-wrapper"},[e("div",{staticClass:"panel-body"},[e("div",{staticClass:"table-responsive"},[e("table",{staticClass:"table"},[e("thead",{staticClass:"font-weight-bold text-center"},[e("tr",[e("th",{staticClass:"w-3"},[t._v("#")]),t._v(" "),e("th",{staticClass:"text-left w-50"},[t._v(t._s(t.array_get(t.trans,"module.path")))]),t._v(" "),e("th",[t._v(t._s(t.array_get(t.trans,"module.path_view")))]),t._v(" "),e("th",[t._v(t._s(t.array_get(t.trans,"module.path_time")))])])]),t._v(" "),t.blank(t.pages)?e("tbody",{staticClass:"text-center"},[e("tr",[e("td",{staticClass:"text-muted",attrs:{colspan:"4"}},[t._v(t._s(t.array_get(t.trans,"module.path_empty")))])])]):e("tbody",{staticClass:"text-center"},t._l(t.pages,(function(a,s){return e("tr",[e("th",{attrs:{scope:"row"}},[t._v(t._s(s+1))]),t._v(" "),e("td",{staticClass:"text-left text-break-word"},[e("a",{staticClass:"text-primary",attrs:{href:a.url,target:"_blank"}},[t._v(t._s(a.path))])]),t._v(" "),e("td",[t._v(t._s(a.count))]),t._v(" "),e("td",[t._v(t._s(a.time))])])})),0)])])])])])}),[],!1,null,null,null).exports;const w={name:"AgeSource",props:{urls:Object,trans:Object,days:{type:Number,default:30}},data:function(){return{serialChart:null,ageSource:[]}},mounted:function(){this.createAmSerial()},watch:{ageSource:function(t,e){var a=this;JSON.stringify(t)!==JSON.stringify(e)&&(this.serialChart.dataProvider=t,this.$nextTick((function(){a.serialChart.validateData(),a.serialChart.animateAgain()})))}},methods:{createAmSerial:function(){this.serialChart=AmCharts.makeChart("age-source-serial",{hideCredits:!0,type:"serial",theme:"light",dataProvider:this.ageSource,valueAxes:[{gridColor:"#878787",gridAlpha:.2,dashLength:0,color:"#878787"}],gridAboveGraphs:!0,startDuration:1,graphs:[{balloonText:"[[category]]: <b>[[value]]</b>",fillAlphas:.8,lineAlpha:.2,type:"column",valueField:"visits",color:"#878787"}],chartCursor:{categoryBalloonEnabled:!1,cursorAlpha:0,zoomable:!1},categoryField:"age",categoryAxis:{gridPosition:"start",gridAlpha:0,tickPosition:"start",tickLength:20,color:"#878787"},export:{enabled:!1}}),this.updateAgeSource()},updateAgeSource:function(){var t=this;this.filled(this.urls.age_source)&&axios.get(this.urls.age_source+"?days="+this.days).then((function(e){t.ageSource=e.data}))}}};var A=a(2583),S={insert:"head",singleton:!1};c()(A.Z,S);A.Z.locals;const k=(0,i.Z)(w,(function(){var t=this,e=t._self._c;return e("section",{staticClass:"panel h-100-c"},[e("header",{staticClass:"panel-heading"},[e("h2",{staticClass:"h5 float-left"},[t._v(t._s(t.array_get(t.trans,"module.age_source")))])]),t._v(" "),e("div",{staticClass:"panel-wrapper"}),t._v(" "),t._m(0)])}),[function(){var t=this._self._c;return t("div",{staticClass:"panel-body pb-3"},[t("div",{attrs:{id:"age-source-serial"}})])}],!1,null,"6878c0be",null).exports;const P={name:"ReferrerKeyword",props:{urls:Object,trans:Object,days:{type:Number,default:30},max:{type:Number,default:5}},data:function(){return{keywords:[]}},mounted:function(){this.updateData()},methods:{updateData:function(){var t=this;this.filled(this.urls.referrer_keyword)&&axios.get(this.urls.referrer_keyword+"?days="+this.days+"&max="+this.max).then((function(e){t.keywords=e.data}))}}};const O=(0,i.Z)(P,(function(){var t=this,e=t._self._c;return e("section",{staticClass:"panel h-100-c"},[e("header",{staticClass:"panel-heading"},[e("h2",{staticClass:"h5 float-left"},[t._v(t._s(t.array_get(t.trans,"module.referrer_keyword")))])]),t._v(" "),e("div",{staticClass:"panel-wrapper"},[e("div",{staticClass:"panel-body"},[e("div",{staticClass:"table-responsive-sm"},[e("table",{staticClass:"table"},[e("thead",{staticClass:"font-weight-bold"},[e("tr",[e("th",{staticClass:"text-center w-3"},[t._v("#")]),t._v(" "),e("th",[t._v(t._s(t.array_get(t.trans,"module.keyword")))]),t._v(" "),e("th",{staticClass:"text-right"},[t._v(t._s(t.array_get(t.trans,"module.keyword_count")))])])]),t._v(" "),t.blank(t.keywords)?e("tbody",{staticClass:"text-center"},[e("tr",[e("td",{staticClass:"text-muted",attrs:{colspan:"3"}},[t._v(t._s(t.array_get(t.trans,"module.keyword_empty")))])])]):e("tbody",t._l(t.keywords,(function(a,s){return e("tr",[e("th",{staticClass:"text-center",attrs:{scope:"row"}},[t._v(t._s(s+1))]),t._v(" "),e("td",{staticClass:"text-break-word"},[t._v(t._s(a.keyword))]),t._v(" "),e("td",{staticClass:"text-right"},[t._v(t._s(a.count))])])})),0)])])])])])}),[],!1,null,null,null).exports,j={name:"SiteDashboard",components:{AdminLayout:s.Z,PageSummaryBlock:r,PageVisitedSource:h,PageCurrentVisitor:m,PageTopBrowsers:v,PageWorldSource:C,PagePathViews:x,PageAgeSource:k,PageReferrerKeyword:O},props:{urls:Object,configs:Object},data:function(){return{breadcrumbs:[],trans:{}}},created:function(){this.getUI()},mounted:function(){},methods:{getUI:function(){var t=this;axios.get(this.urls.api_ui).then((function(e){t.breadcrumbs=e.data.data.breadcrumbs,t.trans=e.data.data.trans,t.$nextTick((function(){window.dispatchEvent(new Event("resize"))}))}))}}};const T=(0,i.Z)(j,(function(){var t=this,e=t._self._c;return e("admin-layout",{attrs:{urls:t.urls,configs:t.configs,trans:t.trans,breadcrumbs:t.breadcrumbs}},[e("div",{staticClass:"row"},[e("div",{staticClass:"col-bg-3 col-lg-6 col-sm-6 col-xs-12"},[e("PageVisitedSource",{attrs:{urls:t.urls.dashboard,trans:t.trans,days:30}})],1),t._v(" "),e("div",{staticClass:"col-bg-3 col-lg-6 col-sm-6 col-xs-12"},[e("PageCurrentVisitor",{attrs:{urls:t.urls.dashboard,trans:t.trans,days:30,decimals:2}}),t._v(" "),e("PageTopBrowsers",{attrs:{urls:t.urls.dashboard,trans:t.trans,days:30,max:4}})],1),t._v(" "),e("div",{staticClass:"col-bg-6 col-lg-12"},[e("PageWorldSource",{attrs:{urls:t.urls.dashboard,trans:t.trans,days:30}})],1)]),t._v(" "),e("div",{staticClass:"row text-center"},[e("div",{staticClass:"col-xl-3 col-lg-6 col-sm-6"},[e("PageSummaryBlock",{attrs:{url:t.urls.dashboard.today_total_visitors,subject:t.array_get(t.trans,"module.today_visitors"),"bg-class":"bg-main","icon-class":"icon-accessibility"}})],1),t._v(" "),e("div",{staticClass:"col-xl-3 col-lg-6 col-sm-6"},[e("PageSummaryBlock",{attrs:{url:t.urls.dashboard.total_inbox,subject:t.array_get(t.trans,"module.total_inbox"),"bg-class":"bg-warning","icon-class":"icon-mail-envelope-open"}})],1),t._v(" "),e("div",{staticClass:"col-xl-3 col-lg-6 col-sm-6"},[e("PageSummaryBlock",{attrs:{url:t.urls.dashboard.total_product,subject:t.array_get(t.trans,"module.total_product"),"bg-class":"bg-success","icon-class":"icon-database"}})],1),t._v(" "),e("div",{staticClass:"col-xl-3 col-lg-6 col-sm-6"},[e("PageSummaryBlock",{attrs:{url:t.urls.dashboard.total_new_visitors,subject:t.array_get(t.trans,"module.total_new_visitors"),"bg-class":"bg-primary","icon-class":"icon-eye2"}})],1)]),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-bg-4 col-lg-12"},[e("PagePathViews",{attrs:{urls:t.urls.dashboard,trans:t.trans,days:30,max:5}})],1),t._v(" "),e("div",{staticClass:"col-bg-4 col-lg-6 col-sm-12"},[e("PageAgeSource",{attrs:{urls:t.urls.dashboard,trans:t.trans,days:30}})],1),t._v(" "),e("div",{staticClass:"col-bg-4 col-lg-6 col-sm-12"},[e("PageReferrerKeyword",{attrs:{urls:t.urls.dashboard,trans:t.trans,days:30,max:5}})],1)])])}),[],!1,null,null,null).exports}}]);
//# sourceMappingURL=Site-Dashboard.js.map