<template>
  <admin-layout :urls="urls" :configs="configs" :trans="trans" :breadcrumbs="breadcrumbs" v-slot:default="slotProps" ref="base_edit">
    <section class="panel panel-default">
      <header class="panel-heading">
        <h1 class="h5 float-left font-weight-bold">#{{ liveValues.serial }}
          {{ array_get(trans, 'ui.topic.inbox_content') }}
          <span
            class="btn btn-sm btn-light"
            :class="[liveValues.starred ? 'text-main' : 'text-muted']"
            :title="array_get(trans, 'ui.button.starred_' + (liveValues.starred ? 1 : 0))">
            <i :class="[liveValues.starred ? 'icon-star-full' : 'icon-star-empty']"></i>
          </span></h1>
        <a class="btn btn-sm rounded-pill btn-secondary ml-2"
           v-if="filled(urls.guide)"
           :href="urls.guide" target="_blank" :title="array_get(trans, 'ui.button.guide')">
          <i class="icon-help"></i>
        </a>
        <site-page-actions :urls="urls" :trans="trans" />
      </header>

      <div class="panel-wrapper">
        <div class="panel-body">
          <h2 class="h4">
            <span class="badge badge-main mr-2">{{ liveValues.inboxCategory }}</span>{{ liveValues.subject }}
          </h2>
          <hr />
          <div class="row no-gutters">
            <div class="col-sm">
              <p class="mb-0" v-if="filled(liveValues.name) || filled(liveValues.email)">
                <strong v-if="filled(liveValues.name)" class="text-dark">"{{ liveValues.name }}"</strong>
                <span v-if="filled(liveValues.email)" class="text-muted small">&lt; {{ liveValues.email }} &gt;</span>
              </p>
              <p class="mb-0 small text-muted">IP: {{ liveValues.ip }}</p>
            </div>
            <div class="col-sm-auto text-sm-right">
              <p class="mb-0 form-text small text-muted">{{ liveValues.created_at }}</p>
              <p class="mb-0 small text-muted">{{ array_get(trans, 'module.updated_at') }}:
                {{ liveValues.updated_at }}</p>
            </div>
          </div>
          <hr />
          <div class="inbox-view">
            <table class="table table-sm table-bordered mb-3">
              <thead class="thead-default">
              <tr class="table-secondary">
                <th class="w-15">{{ array_get(trans, 'ui.topic.inbox_table_column') }}</th>
                <th>{{ array_get(trans, 'ui.topic.inbox_table_value') }}</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="column in columns">
                <td>{{ array_get(trans, 'module.' + column.column) }}</td>
                <td>{{ liveValues[column.column] }}</td>
              </tr>
              </tbody>
            </table>
            <div class="text" v-html="nl2pa(liveValues.content)"></div>
          </div>

          <fieldset class="mt-4">
            <legend class="legend h6 mb-4">
              <i class="icon-angle-double-down2 mr-2"></i>{{ array_get(trans, 'ui.legend.advance') }}</legend>

            <minmax-selection
              :trans="trans"
              :configs="{
                key: 'status', language: false,
                options: {required: true, options: getOptions('status', options)}
              }"
              v-model="liveValues.status" />

            <minmax-selection
              :trans="trans"
              :configs="{
                key: 'archive', language: false,
                options: {required: true, options: getOptions('archive', options)}
              }"
              v-model="liveValues.archive" />

            <page-inbox-owner-table
              :trans="trans"
              :configs="{
                key: 'inboxOwners', language: false,
                options: {
                  required: true, options: getOptions('owner_type', options),
                  details: getOptions('inboxOwners', options)
                }
              }"
              v-model="liveValues.inboxOwners" />

          </fieldset>
        </div>
      </div>
    </section>

    <page-inbox-reply-grid
      v-if="filled(array_get(urls, 'api_reply.api_grid'))"
      :urls="array_get(urls, 'api_reply')"
      :trans="trans"
      ref="replyGrid"/>

    <page-inbox-reply-create
      v-if="filled(array_get(urls, 'api_reply.store')) && !liveValues.archive"
      :urls="array_get(urls, 'api_reply')"
      :modifiable="false"
      v-on:replyCreated="updateData" />

  </admin-layout>
</template>

<script>
import AdminLayout from "../../Components/Layout/SiteMain";
import SitePageActions from "../../Components/Layout/SitePageActions";
import DefaultShow from "../../Components/Mixins/DefaultShow";
import MinmaxSelection from "../../Components/Form/Static/Selection";
import PageInboxReplyCreate from "../../Components/PageInboxReceived/InboxReplyCreate";
import PageInboxReplyGrid from "../../Components/PageInboxReceived/InboxReplyGrid";
import PageInboxOwnerTable from "../../Components/PageInboxReceived/OwnerTable";

export default {
  name: "InboxReceivedShow",
  mixins: [DefaultShow],
  components: {
    AdminLayout,
    SitePageActions,
    MinmaxSelection,
    PageInboxReplyCreate,
    PageInboxReplyGrid,
    PageInboxOwnerTable
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
    },
    updateData: function () {
      this.getData();
      this.$refs.replyGrid.getData();
    },
    nl2pa: function (content) {
      return this.blank(content) ? ''
        : '<p>' + content
          .replace(/\n\r/ig, '{[pa]}')
          .replace(/\n/ig, '{[pa]}')
          .replace(/\{\[pa]}/ig, "</p>\n<p>")
          .replace(/<p><\/p>/ig, "<p>&nbsp;</p>") + '</p>';
    }
  }
}
</script>
