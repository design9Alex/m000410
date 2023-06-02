<template>
  <admin-layout :urls="urls" :configs="configs" :trans="trans" :breadcrumbs="breadcrumbs" v-slot:default="slotProps">
    <section class="panel panel-default" :style="{minHeight: slotProps.pageMinHeight + 'px'}">
      <header class="panel-heading">
        <h1 class="h5 float-left font-weight-bold">{{ array_get(configs, 'title') }}
          {{ array_get(trans, 'ui.topic.import') }}</h1>
        <a class="btn btn-sm rounded-pill btn-secondary ml-2"
           v-if="filled(urls.guide)"
           :href="urls.guide" target="_blank" :title="array_get(trans, 'ui.button.guide')">
          <i class="icon-help"></i>
        </a>
        <site-page-actions :urls="urls" :trans="trans" />
      </header>

      <div class="panel-wrapper">
        <div class="panel-body">
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)"
                 :class="currentPanel === 'import' ? ['show', 'active'] : []" role="tab"
                 @click="currentPanel = 'import'">
                {{ array_get(trans, 'ui.button.import') }}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)"
                 :class="currentPanel === 'records' ? ['show', 'active'] : []" role="tab"
                 @click="currentPanel = 'records'">
                {{ array_get(trans, 'ui.button.log') }}
              </a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade"
                 :class="currentPanel === 'import' ? ['show', 'active'] : []" role="tabpanel">
              <fieldset class="mt-4">
                <legend class="legend h6 mb-4">
                  <i class="icon-angle-double-down2 mr-2"></i>{{ array_get(trans, 'ui.legend.main') }}</legend>

                <minmax-files
                  :trans="trans"
                  :configs="{
                    key: 'files', language: false,
                    root: urls.root,
                    fm_base: urls.fm_base,
                    options: {
                      label: array_get(trans, 'ui.import.files'),
                      hint: array_get(trans, 'ui.import.files_hint')
                    }
                  }"
                  v-model="custom.files" />

              </fieldset>

              <fieldset class="mt-4">
                <legend class="legend h6 mb-4">
                  <i class="icon-angle-double-down2 mr-2"></i>{{ array_get(trans, 'ui.legend.advance') }}</legend>

                <div class="form-group row" v-if="filled(array_get(trans, 'languages'))">
                  <label class="col-sm-2 col-form-label">
                    {{ array_get(trans, 'ui.import.language') }}
                  </label>
                  <div class="col-sm-10">
                    <div
                      v-for="language in array_get(trans, 'languages')"
                      class="custom-control custom-radio custom-control-inline mt-2">
                      <input
                        class="custom-control-input"
                        type="radio"
                        :id="'language-' + language.value"
                        name="language"
                        :value="language.value"
                        v-model="custom.language">
                      <label class="custom-control-label" :for="'language-' + language.value">
                        {{ language.label }}
                      </label>
                    </div>
                  </div>
                  <small class="form-text text-muted ml-sm-auto col-sm-10">
                    <span v-html="array_get(trans, 'ui.import.language_hint')"></span>
                  </small>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">
                    {{ array_get(trans, 'ui.import.overwrite') }}
                  </label>
                  <div class="col-sm-10">
                    <div class="custom-control custom-radio custom-control-inline mt-2">
                      <input
                        class="custom-control-input"
                        type="radio"
                        id="overwrite-0"
                        name="overwrite"
                        :value="false"
                        v-model="custom.overwrite">
                      <label class="custom-control-label" for="overwrite-0">
                        {{ array_get(trans, 'ui.import.overwrite_0') }}
                      </label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline mt-2">
                      <input
                        class="custom-control-input"
                        type="radio"
                        id="overwrite-1"
                        name="overwrite"
                        :value="true"
                        v-model="custom.overwrite">
                      <label class="custom-control-label" for="overwrite-1">
                        {{ array_get(trans, 'ui.import.overwrite_1') }}
                      </label>
                    </div>
                  </div>
                  <small class="form-text text-muted ml-sm-auto col-sm-10">
                    <span v-html="array_get(trans, 'ui.import.overwrite_hint')"></span>
                  </small>
                </div>
              </fieldset>

              <div class="text-center my-4 form-btn-group">
                <b-overlay
                  :show="$store.state.formBusy"
                  opacity="0.6"
                  spinner-small
                  spinner-variant="main"
                  class="d-inline-block">
                  <button
                    class="btn btn-main"
                    type="button"
                    @click="submitForm(trans)">
                    {{ array_get(trans, 'ui.button.submit') }}</button>
                </b-overlay>
                <button
                  class="btn btn-default"
                  type="button"
                  :disabled="$store.state.formBusy"
                  @click="filters = []">
                  {{ array_get(trans, 'ui.button.reset') }}</button>
              </div>
            </div>
          </div>
          <div class="tab-content">
            <div class="tab-pane fade dataTables_wrapper"
                 :class="currentPanel === 'records' ? ['show', 'active'] : []" role="tabpanel">
              <fieldset class="mt-4">
                <legend class="legend h6 mb-4">
                  <i class="icon-angle-double-down2 mr-2"></i>{{ array_get(trans, 'ui.legend.records') }}</legend>

                <table class="table table-sm table-bordered mb-1">
                  <thead class="theme-default">
                  <tr class="text-center">
                    <th class="w-25">{{ array_get(trans, 'ui.import.records.created_at') }}</th>
                    <th class="w-15">{{ array_get(trans, 'ui.import.records.status') }}</th>
                    <th class="w-15">{{ array_get(trans, 'ui.import.records.success') }}</th>
                    <th>{{ array_get(trans, 'ui.import.records.file') }}</th>
                  </tr>
                  </thead>
                  <tbody v-if="blank(records)">
                  <tr>
                    <td colspan="4" class="text-center text-muted">
                      {{ array_get(trans, 'ui.message.empty_list') }}
                    </td>
                  </tr>
                  </tbody>
                  <tbody v-else>
                  <tr class="text-center" v-for="record in records">
                    <td>{{ record.created_at }}</td>
                    <td>{{ record.status }}</td>
                    <td>{{ record.success }}</td>
                    <td class="text-left" v-if="filled(record.files)">
                      <template v-for="(file, index) in record.files">
                        <a v-if="filled(file.url)" :href="file.url" download>{{ file.name }}</a>
                        <span v-else>{{ file.name }}</span>
                        <span v-if="index < record.files.length - 1">, </span>
                      </template>

                    </td>
                    <td class="text-left" v-else>-</td>
                  </tr>
                  </tbody>
                </table>
                <div class="row mt-3">
                  <div class="col-md-6 text-center text-md-left">
                    <span class="text-muted">{{ recordsPaginationInfo }}</span>
                  </div>
                  <div class="col-md-6 text-center text-md-right">
                    <div class="dataTables_paginate paging_simple_numbers">
                      <ul class="pagination">
                        <li class="paginate_button page-item previous"
                            :class="{'disabled': records_pagination.page <= 1}">
                          <a href="#" class="page-link" @click="records_pagination.page -= 1">
                            <i class="icon-keyboard_arrow_left"></i>
                          </a>
                        </li>
                        <li class="paginate_button page-item" :class="{active: records_pagination.page === 1}">
                          <span v-if="records_pagination.page === 1" class="page-link">1</span>
                          <a v-else href="#" class="page-link" @click="records_pagination.page = 1">1</a>
                        </li>
                        <li class="paginate_button page-item" :class="{active: records_pagination.page === 2}"
                            v-if="records_pagination.totalPage === 7 || (records_pagination.totalPage > 2 && records_pagination.page < 5)">
                          <span v-if="records_pagination.page === 2" class="page-link">2</span>
                          <a v-else href="#" class="page-link" @click="records_pagination.page = 2">2</a>
                        </li>
                        <li class="paginate_button page-item" :class="{active: records_pagination.page === 3}"
                            v-if="records_pagination.totalPage === 7 || (records_pagination.totalPage > 3 && records_pagination.page < 5)">
                          <span v-if="records_pagination.page === 3" class="page-link">3</span>
                          <a v-else href="#" class="page-link" @click="records_pagination.page = 3">3</a>
                        </li>
                        <li class="paginate_button page-item" :class="{active: records_pagination.page === 4}"
                            v-if="records_pagination.totalPage === 7 || (records_pagination.totalPage > 4 && records_pagination.page < 5)">
                          <span v-if="records_pagination.page === 4" class="page-link">4</span>
                          <a v-else href="#" class="page-link" @click="records_pagination.page = 4">4</a>
                        </li>
                        <li class="paginate_button page-item"
                            v-if="records_pagination.totalPage !== 7 && (records_pagination.totalPage > 5 && records_pagination.page < 5)">
                          <a href="#" class="page-link" @click="records_pagination.page = 5">5</a>
                        </li>
                        <li class="paginate_button page-item disabled"
                            v-if="records_pagination.totalPage !== 7 && records_pagination.page > 4">
                          <span class="page-link">...</span>
                        </li>
                        <li class="paginate_button page-item"
                            v-if="records_pagination.page > 4 && records_pagination.page < records_pagination.totalPage - 3">
                          <a href="#" class="page-link" @click="records_pagination.page -= 1">{{ records_pagination.page - 1 }}</a>
                        </li>
                        <li class="paginate_button page-item active"
                            v-if="records_pagination.page > 4 && records_pagination.page < records_pagination.totalPage - 3">
                          <span class="page-link">{{ records_pagination.page }}</span>
                        </li>
                        <li class="paginate_button page-item"
                            v-if="records_pagination.page > 4 && records_pagination.page < records_pagination.totalPage - 3">
                          <a href="#" class="page-link" @click="records_pagination.page += 1">{{ records_pagination.page + 1 }}</a>
                        </li>
                        <li class="paginate_button page-item disabled"
                            v-if="records_pagination.totalPage !== 7 && records_pagination.page < records_pagination.totalPage - 3">
                          <span class="page-link">...</span>
                        </li>
                        <li class="paginate_button page-item"
                            :class="{active: records_pagination.page === records_pagination.totalPage - 4}"
                            v-if="records_pagination.totalPage !== 7 && (records_pagination.totalPage > 7 && records_pagination.page > records_pagination.totalPage - 4)">
                          <span v-if="records_pagination.page === records_pagination.totalPage - 4"
                                class="page-link">{{ records_pagination.totalPage - 4 }}</span>
                          <a v-else href="#" class="page-link"
                             @click="records_pagination.page = records_pagination.totalPage - 4">{{ records_pagination.totalPage - 4 }}</a>
                        </li>
                        <li class="paginate_button page-item"
                            :class="{active: records_pagination.page === records_pagination.totalPage - 3}"
                            v-if="records_pagination.totalPage !== 7 && (records_pagination.totalPage > 6 && records_pagination.page > records_pagination.totalPage - 4)">
                          <span v-if="records_pagination.page === records_pagination.totalPage - 3"
                                class="page-link">{{ records_pagination.totalPage - 3 }}</span>
                          <a v-else href="#" class="page-link"
                             @click="records_pagination.page = records_pagination.totalPage - 3">{{ records_pagination.totalPage - 3 }}</a>
                        </li>
                        <li class="paginate_button page-item"
                            :class="{active: records_pagination.page === records_pagination.totalPage - 2}"
                            v-if="records_pagination.totalPage === 7 || (records_pagination.totalPage > 5 && records_pagination.page > records_pagination.totalPage - 4)">
                          <span v-if="records_pagination.page === records_pagination.totalPage - 2"
                                class="page-link">{{ records_pagination.totalPage - 2 }}</span>
                          <a v-else href="#" class="page-link"
                             @click="records_pagination.page = records_pagination.totalPage - 2">{{ records_pagination.totalPage - 2 }}</a>
                        </li>
                        <li class="paginate_button page-item"
                            :class="{active: records_pagination.page === records_pagination.totalPage - 1}"
                            v-if="records_pagination.totalPage === 7 || (records_pagination.totalPage > 4 && records_pagination.page > records_pagination.totalPage - 4)">
                          <span v-if="records_pagination.page === records_pagination.totalPage - 1"
                                class="page-link">{{ records_pagination.totalPage - 1 }}</span>
                          <a v-else href="#" class="page-link"
                             @click="records_pagination.page = records_pagination.totalPage - 1">{{ records_pagination.totalPage - 1 }}</a>
                        </li>
                        <li class="paginate_button page-item"
                            :class="{active: records_pagination.page === records_pagination.totalPage}"
                            v-if="records_pagination.totalPage > 1">
                          <span v-if="records_pagination.page === records_pagination.totalPage"
                                class="page-link">{{ records_pagination.totalPage }}</span>
                          <a v-else href="#" class="page-link"
                             @click="records_pagination.page = records_pagination.totalPage">{{ records_pagination.totalPage }}</a>
                        </li>
                        <li class="paginate_button page-item next"
                            :class="{'disabled': records_pagination.page >= records_pagination.totalPage}">
                          <a href="#" class="page-link" @click="records_pagination.page += 1">
                            <i class="icon-keyboard_arrow_right"></i>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </fieldset>
            </div>
          </div>
        </div>
      </div>
    </section>
  </admin-layout>
</template>

<script>
import {BOverlay} from 'bootstrap-vue';
import AdminLayout from "../../Components/Layout/SiteMain";
import SitePageActions from "../../Components/Layout/SitePageActions";
import BootstrapSelect from "../../Components/Module/BootstrapSelect";
import MinmaxFiles from "../../Components/Form/Files";
import FilterCollection from "../../Components/Form/Filter/Collection";
import FilterDate from "../../Components/Form/Filter/Date";
import FilterDatetime from "../../Components/Form/Filter/Datetime";
import FilterKeyword from "../../Components/Form/Filter/Keyword";
import FilterNumeric from "../../Components/Form/Filter/Numeric";
import FilterTag from "../../Components/PageIoData/FilterTag";
import SortingTag from "../../Components/PageIoData/SortingTag";

export default {
  name: "IoDataImport",
  components: {
    BOverlay,
    AdminLayout,
    SitePageActions,
    BootstrapSelect,
    MinmaxFiles,
    FilterCollection,
    FilterDate,
    FilterDatetime,
    FilterKeyword,
    FilterNumeric,
    FilterTag,
    SortingTag
  },
  props: {
    urls: Object,
    configs: Object
  },
  data() {
    return {
      breadcrumbs: [],
      trans: {},
      columns: [],
      options: [],
      records: [],
      records_pagination: {
        baseAmount: 0,
        totalAmount: 0,
        totalPage: 1,
        page: 1,
        perPage: 10,
      },
      records_timer: null,
      custom: {
        files: [],
        overwrite: false,
        language: null,
      },
      currentPanel: 'import',
      filterColumn: null,
      customColumns: null,
      sortingColumn: null,
      sortingDirection: 'asc'
    }
  },
  created() {
    let tag = window.location.href.split('#')[1];
    if (typeof tag !== "undefined") {
      this.currentPanel = tag;
    }

    this.getUI();
    this.renderRecords();
  },
  computed: {
    recordsRowStart: function () {
      if (this.records_pagination.totalAmount < 1) {
        return 0;
      }

      if (this.records_pagination.perPage === -1) {
        return 1;
      }

      return this.records_pagination.perPage * ((this.records_pagination.page < 1 ? 1 : this.records_pagination.page) - 1) + 1;
    },
    recordsRowEnd: function () {
      if (this.records_pagination.perPage === -1) {
        return this.records_pagination.totalAmount;
      }

      let endRow = this.records_pagination.page * this.records_pagination.perPage;
      return endRow > this.records_pagination.totalAmount ? this.records_pagination.totalAmount : endRow;
    },
    recordsPaginationInfo: function () {
      let text = this.array_get(this.trans, 'ui.grid.pagination_info');

      if (this.blank(text)) {
        return null;
      }

      return this.array_get(this.trans, 'ui.grid.per_page') + ' '
        + this.records_pagination.perPage
        + text
          .replace(':start', this.recordsRowStart)
          .replace(':end', this.recordsRowEnd)
          .replace(':total', this.records_pagination.totalAmount);
    }
  },
  watch: {
    customColumns: {
      handler: function (afterVal) {
        if (this.blank(afterVal)) {
          this.custom.columns = [];
        } else {
          for (let i in afterVal) {
            if (this.custom.columns.indexOf(afterVal[i]) === -1) {
              this.custom.columns.push(afterVal[i]);
            }
          }
          if (this.filled(this.custom.columns)) {
            for (let i in this.custom.columns) {
              if (afterVal.indexOf(this.custom.columns[i]) === -1) {
                this.custom.columns.splice(parseInt(i), 1);
              }
            }
          }
        }
      },
      deep: true
    },
    currentPanel: function (afterVal) {
      if (afterVal === 'records') {
        this.renderRecords();
        this.records_timer = setInterval(this.renderRecords, 3000);
      } else {
        clearInterval(this.records_timer);
      }
    },
    "records_pagination.page": function (afterVal) {
      if (afterVal < 1) {
        this.records_pagination.page = 1;
      } else if (afterVal > this.records_pagination.totalPage) {
        this.records_pagination.page = this.records_pagination.totalPage;
      } else if (this.records_pagination.perPage === -1 && this.records_pagination.page !== 1) {
        this.records_pagination.page = 1;
      } else {
        clearInterval(this.records_timer);
        this.renderRecords();
        this.records_timer = setInterval(this.renderRecords, 3000);
      }
    }
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

      for (let index in this.array_get(this.trans, 'languages', [])) {
        if (this.custom.language === null) {
          this.custom.language = this.trans.languages[index].value;
        }
      }

      this.$nextTick(function () {
        window.dispatchEvent(new Event('resize'));
      });
    },
    submitForm: function () {
      if (this.filled(this.urls.import)) {
        axios
          .post(this.urls.import, this.custom)
          .then((response) => {
            if (response.data.code === '0000') {
              this.$swal({text: this.array_get(this.trans, 'ui.message.import_succeeded'), icon: 'success', timer: 2000})
                .then(() => this.currentPanel = 'records');
            }
          })
          .catch(() => {
              this.$swal({text: this.array_get(this.trans, 'ui.message.import_failed'), icon: 'error'});
          })
          .finally(() => {
            this.custom.files = [];
            this.custom.overwrite = false;
          });
      }
    },
    renderRecords: function () {
      if (this.filled(this.urls.api_records)) {
        axios
          .post(this.urls.api_records, {
            page: this.records_pagination.page,
            per_page: this.records_pagination.perPage
          })
          .then((response) => {
            this.records = response.data.data.data;
            this.records_pagination.baseAmount = response.data.data.base_amount;
            this.records_pagination.totalAmount = response.data.data.total_amount;
            this.records_pagination.totalPage = response.data.data.total_page;
            this.records_pagination.page = response.data.data.page;
            this.records_pagination.perPage = response.data.data.per_page;
          });
      }
    }
  }
}
</script>
