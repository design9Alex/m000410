<template>
  <admin-layout :urls="urls" :configs="configs" :trans="trans" :breadcrumbs="breadcrumbs" v-slot:default="slotProps" ref="base_edit">
    <section class="panel panel-default">
      <header class="panel-heading">
        <h1 class="h5 float-left font-weight-bold">
          {{ array_get(trans, 'ui.topic.inbox_content') }}
        </h1>
        <a class="btn btn-sm rounded-pill btn-secondary ml-2"
           v-if="filled(urls.guide)"
           :href="urls.guide" target="_blank" :title="array_get(trans, 'ui.button.guide')">
          <i class="icon-help"></i>
        </a>
        <site-page-actions :urls="urls" :trans="trans" />
      </header>

      <div class="panel-wrapper">
        <div class="panel-body">
          <h2 class="h4">{{ liveValues.subject }}</h2>
          <hr />
          <div class="row no-gutters">
            <div class="col-sm">
              <p class="mb-0" v-if="filled(liveValues.to)">
                <strong class="text-dark">{{ liveValues.to }}</strong>
              </p>
              <p v-if="filled(liveValues.bcc)" class="mb-0 small text-muted">
                密件副本 (bcc): {{ liveValues.bcc }}
              </p>
            </div>
            <div class="col-sm-auto text-sm-right">
              <p class="mb-0 form-text small text-muted">{{ liveValues.sent_at }}</p>
              <p v-if="filled(liveValues.ip)" class="mb-0 small text-muted">IP: {{ liveValues.ip }}</p>
            </div>
          </div>
          <hr />
          <div class="inbox-view" style="background-color:#f5f5f5">
            <div class="text" v-html="liveValues.content"></div>
          </div>

          <fieldset class="mt-4">
            <legend class="legend h6 mb-4">
              <i class="icon-angle-double-down2 mr-2"></i>{{ array_get(trans, 'ui.legend.advance') }}</legend>

            <div v-if="filled(liveValues.from)" class="form-group row">
              <label class="col-sm-2 col-form-label">{{ array_get(trans, 'module.from') }}</label>
              <div class="col-sm-10">
                <div class="form-text">{{ liveValues.from.name }} ({{ liveValues.from.username }})</div>
              </div>
            </div>

            <div v-if="filled(liveValues.mailable)" class="form-group row">
              <label class="col-sm-2 col-form-label">{{ array_get(trans, 'module.mailable') }}</label>
              <div class="col-sm-10">
                <div class="form-text">{{ liveValues.mailable.type }}：<!--
                  --><a :href="liveValues.mailable.url" target="_blank">{{ liveValues.mailable.serial }}</a>
                </div>
              </div>
            </div>

            <div v-if="filled(liveValues.receiver)" class="form-group row">
              <label class="col-sm-2 col-form-label">{{ array_get(trans, 'module.receiver') }}</label>
              <div class="col-sm-10">
                <div class="form-text">{{ liveValues.receiver.type }}：<!--
                  --><a :href="liveValues.receiver.url" target="_blank">{{ liveValues.receiver.name }}</a>
                </div>
              </div>
            </div>

          </fieldset>
        </div>
      </div>
    </section>
  </admin-layout>
</template>

<script>
import AdminLayout from "../../Components/Layout/SiteMain";
import SitePageActions from "../../Components/Layout/SitePageActions";
import DefaultShow from "../../Components/Mixins/DefaultShow";
import MinmaxRadio from "../../Components/Form/Radio";
import PageInboxReplyCreate from "../../Components/PageInboxReceived/InboxReplyCreate";
import PageInboxReplyGrid from "../../Components/PageInboxReceived/InboxReplyGrid";

export default {
  name: "InboxSentShow",
  mixins: [DefaultShow],
  components: {
    AdminLayout,
    SitePageActions,
    MinmaxRadio,
    PageInboxReplyCreate,
    PageInboxReplyGrid
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
