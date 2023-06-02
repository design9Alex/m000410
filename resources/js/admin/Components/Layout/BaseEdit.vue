<template>
  <admin-layout :urls="urls" :configs="configs" :trans="trans" :breadcrumbs="breadcrumbs" v-slot:default="slotProps">
    <section class="panel panel-default" :style="{minHeight: slotProps.pageMinHeight + 'px'}">
      <header class="panel-heading">
        <h1 class="h5 float-left font-weight-bold">{{ array_get(trans, 'title') }}
          {{ array_get(trans, 'ui.topic.edit') }}</h1>
        <a class="btn btn-sm rounded-pill btn-secondary ml-2"
           v-if="filled(urls.guide)"
           :href="urls.guide" target="_blank" :title="array_get(trans, 'ui.button.guide')">
          <i class="icon-help"></i>
        </a>
        <site-page-actions
          :urls="urls"
          :trans="trans"
          :live-values="liveValues"
          v-on:draft-loaded="$emit('draft-loaded', $event)">
          <slot name="slotSitePageActions"></slot>
        </site-page-actions>
      </header>

      <div class="panel-wrapper">
        <div class="panel-body">
          <slot name="slotPanelBody">
            <div class="form-horizontal">
              <slot v-bind:trans="trans"
                    v-bind:columns="columns"
                    v-bind:options="options" />
            </div>
          </slot>
        </div>
      </div>
    </section>
  </admin-layout>
</template>

<script>
import AdminLayout from "./SiteMain";
import SitePageActions from "./SitePageActions";

export default {
  name: "BaseEdit",
  components: {
    AdminLayout,
    SitePageActions
  },
  props: {
    urls: Object,
    configs: Object,
    liveValues: {
      type: Object,
      default: () => {
        return {};
      }
    }
  },
  data() {
    return {
      breadcrumbs: [],
      trans: {},
      columns: [],
      options: []
    }
  },
  created() {
    this.getUI();
  },
  methods: {
    getUI: function () {
      if (this.filled(this.urls.api_ui)) {
        axios
          .get(this.urls.api_ui)
          .then((response) => {
            this.breadcrumbs = response.data.data.breadcrumbs;
            this.updateUI(response.data.data.trans, response.data.data.columns, response.data.data.options);
          });
      }
    },
    updateUI: function (trans, columns, options) {
      this.trans = trans;
      this.columns = columns;
      this.options = options;

      this.$nextTick(function () {
        window.dispatchEvent(new Event('resize'));
      });
    }
  }
}
</script>
