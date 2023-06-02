<template>
  <div class="wrapper" :class="{'slide-nav-close': !menuActive}">

    <site-header
      :header-url="urls.api_header"
      :menu-active="menuActive"
      :trans="trans"
      v-on:toggle-menu="menuActive = $event"></site-header>

    <div class="border-box page-content">
      <div class="content-header">
        <site-breadcrumbs :breadcrumbs="breadcrumbs" />
      </div>

      <div class="content-body">
        <slot v-bind:pageMinHeight="pageMinHeight" />
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
import SiteHeader from "./SiteHeader";
import SiteFooter from "./SiteFooter";
import SiteMenu from "./SiteMenu";
import SiteBreadcrumbs from "./SiteBreadcrumbs";

export default {
  name: 'SiteMain',
  components: {
    SiteHeader,
    SiteFooter,
    SiteMenu,
    SiteBreadcrumbs
  },
  props: {
    urls: Object,
    configs: Object,
    trans: Object,
    breadcrumbs: Array
  },
  data() {
    return {
      menuActive: true,
      dataLanguage: 'zh-TW',
      pageMinHeight: 0,
      authTimer: null
    }
  },
  created() {
    this.menuActive = window.innerWidth >= this.minmaxConfig.mobileWidthX;
  },
  mounted() {
    window.addEventListener('resize', () => {
      this.changePageSize();
      this.changeMenuToggle();
    });
    this.authTimer = setTimeout(this.validateAuth, 300000);
  },
  watch: {
    pageMinHeight: function (val) {
      this.$emit('page-min-height-change', val);
    }
  },
  methods: {
    changePageSize: function () {
      let h = window.innerHeight;
      let w = window.innerWidth;
      if (document.querySelector('.content-header')
        && document.querySelector('.page-footer')
        && document.querySelector('.page-header')) {
        let contentH = document.querySelector('.content-header').offsetHeight;
        //let pageF = document.querySelector('.page-footer').offsetHeight;
        let pageH = document.querySelector('.page-header').offsetHeight;
        let contentHeight = h - contentH - pageH - 35;

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
      if (window.innerWidth < this.minmaxConfig.mobileWidthX) {
        if (this.menuActive) {
          setTimeout(() => {_self.menuActive = false}, 200);
        }
      } else {
        if (!this.menuActive) {
          setTimeout(() => {_self.menuActive = true}, 200);
        }
      }
    },
    validateAuth: function () {
      let _self = this;
      if (_self.array_get(_self.urls, 'validate_auth')) {
        axios
          .get(this.urls.validate_auth)
          .then((response) => {
            if (response.data.code === '0000') {
              this.authTimer = setTimeout(this.validateAuth, 300000);
            } else {
              //location.reload();
            }
          })
          .catch(() => {
            //location.reload();
          });
      } else {
        //location.reload();
      }
    }
  }
}
</script>
