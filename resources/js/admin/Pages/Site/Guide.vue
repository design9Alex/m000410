<template>
  <div class="wrapper" :class="{'slide-nav-close': !menuActive}">

    <site-header
      :header-url="urls.api_header"
      :menu-active="menuActive"
      v-on:toggle-menu="menuActive = $event"></site-header>

    <div class="page-content">
      <div class="content-header">
        <site-breadcrumbs :breadcrumbs="breadcrumbs" />
      </div>

      <div class="content-body bg-white">
        <section class="markdown" v-html="content"></section>
      </div>
    </div>

    <site-menu
      :menu-url="urls.api_menu"
      :current-menu-id="configs.page_id"
      v-on:toggle-menu="menuActive = $event"></site-menu>

    <site-footer :footer-url="urls.api_footer"></site-footer>

  </div>
</template>

<script>
import SiteHeader from "../../Components/Layout/SiteHeader";
import SiteFooter from "../../Components/Layout/SiteFooter";
import SiteMenu from "../../Components/Layout/SiteMenu";
import SiteBreadcrumbs from "../../Components/Layout/SiteBreadcrumbs";

export default {
  name: "SiteGuide",
  components: {
    SiteHeader,
    SiteFooter,
    SiteMenu,
    SiteBreadcrumbs
  },
  props: {
    urls: Object,
    configs: Object,
  },
  data() {
    return {
      breadcrumbs: [],
      trans: {},
      menuActive: true,
      dataLanguage: 'zh-TW',
      pageMinHeight: 0,
      content: null
    }
  },
  created() {
    this.menuActive = window.innerHeight >= this.minmaxConfig.mobileWidthX;
    this.getUI();
  },
  mounted() {
    window.addEventListener('resize', () => {
      this.changePageSize();
      this.changeMenuToggle();
    });

    this.getData();
  },
  methods: {
    getUI: function () {
      if (this.filled(this.urls.api_ui)) {
        axios
          .get(this.urls.api_ui)
          .then((response) => {
            this.breadcrumbs = response.data.data.breadcrumbs;
            this.trans = response.data.data.trans;
            this.$nextTick(function () {
              window.dispatchEvent(new Event('resize'));
            });
          });
      }
    },
    getData: function () {
      if (this.filled(this.urls.api_data)) {
        this.content = null;
        axios
          .get(this.urls.api_data)
          .then((response) => {
            this.content = response.data.data.content;
          });
      }
    },
    changePageSize: function () {
      let h = window.innerHeight;
      let w = window.innerWidth;
      if (document.querySelector('.content-header')
        && document.querySelector('.page-footer')
        && document.querySelector('.page-header')) {
        let contentH = document.querySelector('.content-header').offsetHeight;
        let pageF = document.querySelector('.page-footer').offsetHeight;
        let pageH = document.querySelector('.page-header').offsetHeight;
        let contentHeight = h - contentH - pageH - 30;

        if (w < 576) {
          this.pageMinHeight = contentHeight + pageH;
        } else {
          this.pageMinHeight = contentHeight;
        }
      } else {
        this.pageMinHeight = 0;
      }
    },
    changeMenuToggle: function () {
      let _self = this;
      if ($(window).width() < this.minmaxConfig.mobileWidthX) {
        if (this.menuActive) {
          setTimeout(() => {_self.menuActive = false}, 200);
        }
      } else {
        if (!this.menuActive) {
          setTimeout(() => {_self.menuActive = true}, 200);
        }
      }
    },
  }
}
</script>
