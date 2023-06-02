<template>
  <admin-layout :urls="urls" :configs="configs" :trans="trans" :breadcrumbs="breadcrumbs">
    <div class="row">
      <div class="col-bg-3 col-lg-6 col-sm-6 col-xs-12">
        <PageVisitedSource :urls="urls.dashboard" :trans="trans" :days="30" />
      </div>
      <div class="col-bg-3 col-lg-6 col-sm-6 col-xs-12">
        <PageCurrentVisitor :urls="urls.dashboard" :trans="trans" :days="30" :decimals="2" />
        <PageTopBrowsers :urls="urls.dashboard" :trans="trans" :days="30" :max="4" />
      </div>
      <div class="col-bg-6 col-lg-12">
        <PageWorldSource :urls="urls.dashboard" :trans="trans" :days="30" />
      </div>
    </div>

    <div class="row text-center">
      <div class="col-xl-3 col-lg-6 col-sm-6">
        <PageSummaryBlock
          :url="urls.dashboard.today_total_visitors"
          :subject="array_get(trans, 'module.today_visitors')"
          :bg-class="'bg-main'"
          :icon-class="'icon-accessibility'" />
      </div>
      <div class="col-xl-3 col-lg-6 col-sm-6">
        <PageSummaryBlock
          :url="urls.dashboard.total_inbox"
          :subject="array_get(trans, 'module.total_inbox')"
          :bg-class="'bg-warning'"
          :icon-class="'icon-mail-envelope-open'" />
      </div>
      <div class="col-xl-3 col-lg-6 col-sm-6">
        <PageSummaryBlock
          :url="urls.dashboard.total_product"
          :subject="array_get(trans, 'module.total_product')"
          :bg-class="'bg-success'"
          :icon-class="'icon-database'" />
      </div>
      <div class="col-xl-3 col-lg-6 col-sm-6">
        <PageSummaryBlock
          :url="urls.dashboard.total_new_visitors"
          :subject="array_get(trans, 'module.total_new_visitors')"
          :bg-class="'bg-primary'"
          :icon-class="'icon-eye2'" />
      </div>
    </div>

    <div class="row">
      <div class="col-bg-4 col-lg-12">
        <PagePathViews :urls="urls.dashboard" :trans="trans" :days="30" :max="5" />
      </div>
      <div class="col-bg-4 col-lg-6 col-sm-12">
        <PageAgeSource :urls="urls.dashboard" :trans="trans" :days="30" />
      </div>
      <div class="col-bg-4 col-lg-6 col-sm-12">
        <PageReferrerKeyword :urls="urls.dashboard" :trans="trans" :days="30" :max="5" />
      </div>
    </div>
  </admin-layout>
</template>

<script>
import AdminLayout from "../../Components/Layout/SiteMain";
import PageSummaryBlock from "../../Components/PageSite/SummaryBlock";
import PageVisitedSource from "../../Components/PageSite/VisitedSource";
import PageCurrentVisitor from "../../Components/PageSite/CurrentVisitor";
import PageTopBrowsers from "../../Components/PageSite/TopBrowsers";
import PageWorldSource from "../../Components/PageSite/WorldSource";
import PagePathViews from "../../Components/PageSite/PathViews";
import PageAgeSource from "../../Components/PageSite/AgeSource";
import PageReferrerKeyword from "../../Components/PageSite/ReferrerKeyword";

export default {
  name: "SiteDashboard",
  components: {
    AdminLayout,
    PageSummaryBlock,
    PageVisitedSource,
    PageCurrentVisitor,
    PageTopBrowsers,
    PageWorldSource,
    PagePathViews,
    PageAgeSource,
    PageReferrerKeyword
  },
  props: {
    urls: Object,
    configs: Object
  },
  data() {
    return {
      breadcrumbs: [],
      trans: {}
    }
  },
  created() {
    this.getUI();
  },
  mounted() {
  },
  methods: {
    getUI: function () {
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
  }
}
</script>
