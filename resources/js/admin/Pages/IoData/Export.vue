<template>
  <admin-layout :urls="urls" :configs="configs" :trans="trans" :breadcrumbs="breadcrumbs" v-slot:default="slotProps">
    <section class="panel panel-default" :style="{minHeight: slotProps.pageMinHeight + 'px'}">
      <header class="panel-heading">
        <h1 class="h5 float-left font-weight-bold">{{ array_get(configs, 'title') }}
          {{ array_get(trans, 'ui.topic.export') }}</h1>
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
                 :class="currentPanel === 'export' ? ['show', 'active'] : []" role="tab"
                 @click="currentPanel = 'export'">
                {{ array_get(trans, 'ui.button.export') }}
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
                 :class="currentPanel === 'export' ? ['show', 'active'] : []" role="tabpanel">
              <fieldset class="mt-4">
                <legend class="legend h6 mb-4">
                  <i class="icon-angle-double-down2 mr-2"></i>{{ array_get(trans, 'ui.legend.filters') }}</legend>

                <div class="filterTag mb-3 position-relative pt-2 pl-2 pr-2" v-if="filled(custom.filters)">
                  <filter-tag
                    v-for="(row, index) in custom.filters"
                    :key="'filter-tag-' + index"
                    :trans="trans"
                    :filter="row"
                    :options="options"
                    v-on:click="pullFilter(index)" />
                </div>

                <div class="form-group row">
                  <label class="col-sm-2">
                    <bootstrap-select
                      id="export-filter-columns"
                      class="form-control bs-select"
                      data-style="btn-outline-secondary"
                      data-live-search="true"
                      :title="array_get(trans, 'ui.filter.please_select')"
                      :options="filterColumnOptions"
                      :value="filterColumn"
                      v-on:input="filterColumn = $event" />
                  </label>
                  <div class="col-sm-10" v-if="filled(filterColumn)">
                    <component
                      :is="currentComponent"
                      :trans="trans"
                      :configs="currentConfigs"
                      v-on:push="pushFilter($event)" />
                  </div>
                  <small v-if="filled(filterHint)" class="form-text text-muted ml-sm-auto col-sm-10">
                    <span v-html="filterHint"></span>
                  </small>
                </div>
              </fieldset>

              <fieldset class="mt-4">
                <legend class="legend h6 mb-4">
                  <i class="icon-angle-double-down2 mr-2"></i>{{ array_get(trans, 'ui.legend.columns') }}</legend>

                <div class="form-group row">
                  <label class="col-sm-2">
                    <bootstrap-select
                      id="export-custom-columns"
                      class="form-control bs-select"
                      data-style="btn-outline-secondary"
                      data-live-search="true"
                      data-actions-box="true"
                      :title="array_get(trans, 'ui.filter.please_select')"
                      :options="customColumnOptions"
                      :value="customColumns"
                      v-on:input="customColumns = $event"
                      multiple />
                  </label>
                  <div class="col-sm col-md-4" v-if="filled(custom.columns)">
                    <ul class="list-group" @dragover="columnDragging" @drop="columnDropped">
                      <li
                        v-for="(column, index) in custom.columns"
                        draggable="true"
                        @dragstart="columnDrag($event, index)"
                        class="list-group-item d-flex justify-content-between align-items-center">
                        {{ array_get(trans, 'module.' + column) }}
                        <button class="btn btn-sm-delete form-text" type="button" @click="pullColumn(index)">
                          <i class="icon-cross"></i>
                        </button>
                      </li>
                    </ul>
                  </div>
                  <small
                    v-if="filled(array_get(trans, 'ui.export.custom_columns_hint'))"
                    class="form-text text-muted ml-sm-auto col-sm-10">
                    <span v-html="array_get(trans, 'ui.export.custom_columns_hint')"></span>
                  </small>
                </div>
              </fieldset>

              <fieldset class="mt-4">
                <legend class="legend h6 mb-4">
                  <i class="icon-angle-double-down2 mr-2"></i>{{ array_get(trans, 'ui.legend.sorting') }}</legend>

                <div class="filterTag mb-3 position-relative pt-2 pl-2 pr-2" v-if="filled(custom.sorting)">
                  <sorting-tag
                    v-for="(row, index) in custom.sorting"
                    :key="'sorting-tag-' + index"
                    :trans="trans"
                    :sorting="row"
                    :options="options"
                    v-on:click="pullSorting(index)" />
                </div>

                <div class="form-group row">
                  <label class="col-sm-2">
                    <bootstrap-select
                      id="export-custom-sorting"
                      class="form-control bs-select"
                      data-style="btn-outline-secondary"
                      data-live-search="true"
                      :title="array_get(trans, 'ui.filter.please_select')"
                      :options="sortingColumnOptions"
                      :value="sortingColumn"
                      v-on:input="sortingColumn = $event" />
                  </label>
                  <div class="col-sm-10">
                    <div class="form-row mb-2">
                      <div class="col-auto">
                        <div class="custom-control custom-radio custom-control-inline">
                          <input
                            class="custom-control-input"
                            type="radio"
                            id="sorting-direction-asc"
                            name="sorting-direction"
                            value="asc"
                            v-model="sortingDirection">
                          <label class="custom-control-label" for="sorting-direction-asc">
                            {{ array_get(trans, 'ui.filter.direction.asc') }}
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input
                            class="custom-control-input"
                            type="radio"
                            id="sorting-direction-desc"
                            name="sorting-direction"
                            value="desc"
                            v-model="sortingDirection">
                          <label class="custom-control-label" for="sorting-direction-desc">
                            {{ array_get(trans, 'ui.filter.direction.desc') }}
                          </label>
                        </div>
                      </div>
                      <div class="col-auto">
                        <button class="btn btn-primary" type="button" @click="pushSorting">
                          <i class="icon-plus"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </fieldset>

              <fieldset class="mt-4" v-if="configs.importable === true">
                <legend class="legend h6 mb-4">
                  <i class="icon-angle-double-down2 mr-2"></i>{{ array_get(trans, 'ui.legend.advance') }}</legend>

                <div class="form-group row" v-if="filled(array_get(trans, 'languages'))">
                  <label class="col-sm-2 col-form-label">
                    {{ array_get(trans, 'ui.export.language') }}
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
                    <span v-html="array_get(trans, 'ui.export.language_hint')"></span>
                  </small>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">
                    {{ array_get(trans, 'ui.export.importable') }}
                  </label>
                  <div class="col-sm-10">
                    <div class="custom-control custom-radio custom-control-inline mt-2">
                      <input
                        class="custom-control-input"
                        type="radio"
                        id="importable-0"
                        name="importable"
                        :value="false"
                        v-model="custom.importable">
                      <label class="custom-control-label" for="importable-0">
                        {{ array_get(trans, 'ui.export.importable_0') }}
                      </label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline mt-2">
                      <input
                        class="custom-control-input"
                        type="radio"
                        id="importable-1"
                        name="importable"
                        :value="true"
                        v-model="custom.importable">
                      <label class="custom-control-label" for="importable-1">
                        {{ array_get(trans, 'ui.export.importable_1') }}
                      </label>
                    </div>
                  </div>
                  <small class="form-text text-muted ml-sm-auto col-sm-10">
                    <span v-html="array_get(trans, 'ui.export.importable_hint')"></span>
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
                  @click="resetForm()">
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
                    <th class="w-25">{{ array_get(trans, 'ui.export.records.created_at') }}</th>
                    <th class="w-15">{{ array_get(trans, 'ui.export.records.status') }}</th>
                    <th class="w-15">{{ array_get(trans, 'ui.export.records.success') }}</th>
                    <th>{{ array_get(trans, 'ui.export.records.file') }}</th>
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
                    <td class="text-left" v-if="!record.failed && filled(record.files)">
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
import FilterCollection from "../../Components/Form/Filter/Collection";
import FilterDate from "../../Components/Form/Filter/Date";
import FilterDatetime from "../../Components/Form/Filter/Datetime";
import FilterKeyword from "../../Components/Form/Filter/Keyword";
import FilterNumeric from "../../Components/Form/Filter/Numeric";
import FilterTag from "../../Components/PageIoData/FilterTag";
import SortingTag from "../../Components/PageIoData/SortingTag";

export default {
  name: "IoDataExport",
  components: {
    BOverlay,
    AdminLayout,
    SitePageActions,
    BootstrapSelect,
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
        filters: [],
        columns: [],
        sorting: [],
        language: null,
        importable: false
      },
      currentPanel: 'export',
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
    filterHint: function () {
      if (this.filled(this.trans)) {
        switch (this.currentComponent) {
          case 'filter-collection':
            return this.array_get(this.trans, 'ui.filter.hints.collection');
          case 'filter-date':
            return this.array_get(this.trans, 'ui.filter.hints.date');
          case 'filter-datetime':
            return this.array_get(this.trans, 'ui.filter.hints.datetime');
          case 'filter-keyword':
            return this.array_get(this.trans, 'ui.filter.hints.keyword');
          case 'filter-numeric':
            return this.array_get(this.trans, 'ui.filter.hints.numeric');
        }
      }
      return null;
    },
    currentComponent: function () {
      for (let index in this.columns) {
        if (this.columns[index].key === this.filterColumn) {
          return this.columns[index].component;
        }
      }
      return null;
    },
    currentConfigs: function () {
      if (this.currentComponent === 'filter-collection') {
        return {
          options: this.options[this.filterColumn].options
        };
      }

      return {};
    },
    filterColumnOptions: function () {
      let columns = [];

      for (let index in this.columns) {
        if (this.columns[index].hasOwnProperty('component')) {
          columns.push({
            value: this.columns[index].key,
            label: this.array_get(this.trans, 'module.' + this.columns[index].key),
          });
        }
      }

      return columns;
    },
    customColumnOptions: function () {
      let columns = [];

      for (let index in this.columns) {
        if (this.array_get(this.columns, index + '.customizable') !== false) {
          columns.push({
            value: this.columns[index].key,
            label: this.array_get(this.trans, 'module.' + this.columns[index].key),
          });
        }
      }

      return columns;
    },
    sortingColumnOptions: function () {
      let columns = [];

      for (let index in this.columns) {
        if (this.columns[index].sortable !== false) {
          columns.push({
            value: this.columns[index].key,
            label: this.array_get(this.trans, 'module.' + this.columns[index].key),
          });
        }
      }

      return columns;
    },
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
    formatFilter: function (filterRow, type) {
      if (type === 'column') {
        return this.array_get(this.trans, 'module.' + filterRow.column);
      } else if (type === 'rule_type') {
        return this.array_get(this.trans, 'ui.filter.rule_type.' + filterRow.rule_type);
      }

      switch (filterRow) {
        case 'keyword':
          return this.array_get(this.trans, 'ui.filter.operation.' + filterRow.operation).replace(/\([>=<]+\)/, '')
            + ' ' + filterRow.keyword;
      }
    },
    pushFilter: function (condition) {
      if (this.filled(this.filterColumn) && this.filled(condition)) {
        condition.column = this.filterColumn;
        this.custom.filters.push(condition);
      }
    },
    pullFilter: function (index) {
      this.custom.filters.splice(index, 1);
    },
    columnDrag: function ($event, index) {
      $event.dataTransfer.setData("text/plain", index);
      $event.dropEffect = "move";
    },
    columnDragging: function ($event) {
      $event.preventDefault();
      $event.dataTransfer.dropEffect = "move";
    },
    columnDropped: function ($event) {
      $event.preventDefault();
      let sourceIndex = parseInt($event.dataTransfer.getData("text"));
      let target = $event.target.closest('.list-group > li');
      let targetIndex = target === null
        ? this.custom.columns.length - 1
        : Array.from(target.parentNode.children).indexOf(target);

      if (sourceIndex !== targetIndex) {
        let sorted = [];
        for (let i in this.custom.columns) {
          if (parseInt(i) === sourceIndex) continue;

          if (sourceIndex < targetIndex) {
            sorted.push(this.custom.columns[i]);
          }
          if (parseInt(i) === targetIndex) {
            sorted.push(this.custom.columns[sourceIndex]);
          }
          if (sourceIndex > targetIndex) {
            sorted.push(this.custom.columns[i]);
          }
        }

        this.custom.columns = sorted;
      }
    },
    pullColumn: function (index) {
      if (this.blank(this.customColumns)) {
        return;
      }

      let columnIndex = this.customColumns.indexOf(this.custom.columns[index]);
      if (columnIndex !== -1) {
        this.customColumns.splice(columnIndex, 1);
      }
    },
    pushSorting: function () {
      if (this.filled(this.sortingColumn)) {
        this.custom.sorting.push({
          column: this.sortingColumn,
          direction: this.sortingDirection
        });
      }
    },
    pullSorting: function (index) {
      this.custom.sorting.splice(index, 1);
    },
    submitForm: function () {
      if (this.filled(this.urls.export)) {
        axios
          .post(this.urls.export, this.custom)
          .then((response) => {
            if (response.data.code === '0000') {
              this.$swal({text: this.array_get(this.trans, 'ui.message.export_succeeded'), icon: 'success', timer: 2000})
                .then(() => this.currentPanel = 'records');
            }
          })
          .catch(() => {
              this.$swal({text: this.array_get(this.trans, 'ui.message.export_failed'), icon: 'error'});
          });
      }
    },
    resetForm: function () {
      this.custom.filters = [];
      this.custom.columns = [];
      this.custom.sorting = [];
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
