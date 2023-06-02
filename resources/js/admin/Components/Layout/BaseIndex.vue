<template>
  <admin-layout :urls="urls" :configs="configs" :trans="trans" :breadcrumbs="breadcrumbs" v-slot:default="slotProps">
    <section class="panel panel-default" :style="{minHeight: slotProps.pageMinHeight + 'px'}">
      <header class="panel-heading">
        <h1 class="h5 float-left font-weight-bold">{{ array_get(trans, 'title') }}</h1>
        <a class="btn btn-sm rounded-pill btn-secondary ml-2"
           v-if="filled(urls.guide)"
           :href="urls.guide" target="_blank" :title="array_get(trans, 'ui.button.guide')">
          <i class="icon-help"></i>
        </a>
        <div class="float-right">
          <slot name="buttons"
                v-bind:trans="trans"
                v-bind:current-selected="currentSelected"
                v-bind:renderGrid="renderGrid">
            <site-page-actions :urls="urls" :trans="trans">
              <slot name="slotSitePageActions"></slot>
            </site-page-actions>
          </slot>
        </div>
      </header>

      <div class="panel-wrapper">
        <div class="panel-body">
          <grid-filter-panel
            v-if="filled(advanceFilter) && filled(currentAdvanceFilter.conditions)"
            :urls="urls"
            :trans="trans"
            :options="options"
            :advanceFilterUi="advanceFilter"
            :currentAdvanceFilter="currentAdvanceFilter"
            v-on:advanceFilter="redirectWithFilter($event)">
          </grid-filter-panel>

          <grid-filter :trans="trans"
                       :options="options"
                       :search="bindSearch"
                       :filters="filters"
                       :advanceFilterUi="advanceFilter"
                       :advanceFilters="advanceFilters"
                       :currentKeyword="currentKeyword"
                       :currentSearch="currentSearch"
                       :currentFilter="currentFilter"
                       :currentAdvanceFilter="currentAdvanceFilter"
                       v-on:input="currentKeyword = $event"
                       v-on:change="currentSearch = $event"
                       v-on:filter="currentFilter = $event"
                       v-on:advanceFilter="redirectWithFilter($event)"
                       v-on:advanceFilters="redirectWithFilter($event)">
          </grid-filter>

          <grid-breadcrumbs v-if="filled(gridBreadcrumbs)" :breadcrumbs="gridBreadcrumbs" />

          <div class="dataTables_wrapper dt-bootstrap4">
            <table class="table table-responsive-md table-bordered table-striped table-hover mt-2" style="width:100%">
              <thead>
              <slot name="grid-head"
                    v-bind:trans="trans"
                    v-bind:columns="columns"
                    v-bind:allSelected="allSelected"
                    v-bind:allSelectSwitch="allSelectSwitch"
                    v-bind:withSortingClass="withSortingClass"
                    v-bind:addSorting="addSorting"></slot>
              </thead>
              <tbody v-if="blank(values)">
              <tr>
                <td :colspan="columns.length" class="text-center">{{ array_get(trans, 'ui.grid.no_data') }}</td>
              </tr>
              </tbody>
              <tbody v-if="filled(values)">
              <slot name="grid-rows"
                    v-bind:trans="trans"
                    v-bind:columns="columns"
                    v-bind:values="values"
                    v-bind:options="options"
                    v-bind:currentSelected="currentSelected"
                    v-bind:switchSelected="switchSelected"
                    v-bind:renderGrid="renderGrid"></slot>
              </tbody>
            </table>
            <div class="row mt-3">
              <div class="col-md-6 text-center text-md-left">
                <span class="mr-1 text-muted">{{ array_get(trans, 'ui.grid.per_page') }}</span>
                <div class="d-inline-block">
                  <bootstrap-select v-on:input="pagination.perPage = parseInt($event)"
                                    class="bs-select form-control"
                                    data-style="btn-outline-secondary btn-sm"
                                    :value="pagination.perPage"
                                    :options="perPageList" :key="'perPageList'" />
                </div>
                <span class="text-muted">{{ paginationInfo }}</span>
                <span v-if="pagination.totalAmount < pagination.baseAmount">{{ filterInfo }}</span>
              </div>
              <div class="col-md-6 text-center text-md-right">
                <div class="dataTables_paginate paging_simple_numbers">
                  <ul class="pagination">
                    <li class="paginate_button page-item previous"
                        :class="{'disabled': pagination.page <= 1}">
                      <a href="#" class="page-link" @click="pagination.page -= 1">
                        <i class="icon-keyboard_arrow_left"></i>
                      </a>
                    </li>
                    <li class="paginate_button page-item"
                        :class="{active: pagination.page === 1}">
                      <span v-if="pagination.page === 1" class="page-link">1</span>
                      <a v-else href="#" class="page-link" @click="pagination.page = 1">1</a>
                    </li>
                    <li class="paginate_button page-item"
                        :class="{active: pagination.page === 2}"
                        v-if="paginationStatus('left-2')">
                      <span v-if="pagination.page === 2" class="page-link">2</span>
                      <a v-else href="#" class="page-link" @click="pagination.page = 2">2</a>
                    </li>
                    <li class="paginate_button page-item"
                        :class="{active: pagination.page === 3}"
                        v-if="paginationStatus('left-3')">
                      <span v-if="pagination.page === 3" class="page-link">3</span>
                      <a v-else href="#" class="page-link" @click="pagination.page = 3">3</a>
                    </li>
                    <li class="paginate_button page-item"
                        :class="{active: pagination.page === 4}"
                        v-if="paginationStatus('left-4')">
                      <span v-if="pagination.page === 4" class="page-link">4</span>
                      <a v-else href="#" class="page-link" @click="pagination.page = 4">4</a>
                    </li>
                    <li class="paginate_button page-item"
                        :class="{active: pagination.page === 5}"
                        v-if="paginationStatus('left-5')">
                      <span v-if="pagination.page === 5" class="page-link">5</span>
                      <a v-else href="#" class="page-link" @click="pagination.page = 5">5</a>
                    </li>
                    <li class="paginate_button page-item disabled"
                        v-if="paginationStatus('left-dot')">
                      <span class="page-link">...</span>
                    </li>
                    <li class="paginate_button page-item"
                        v-if="paginationStatus('mid-left')">
                      <a href="#" class="page-link" @click="pagination.page -= 1">{{ pagination.page - 1 }}</a>
                    </li>
                    <li class="paginate_button page-item active"
                        v-if="paginationStatus('mid-center')">
                      <span class="page-link">{{ pagination.page }}</span>
                    </li>
                    <li class="paginate_button page-item"
                        v-if="paginationStatus('mid-right')">
                      <a href="#" class="page-link" @click="pagination.page += 1">{{ pagination.page + 1 }}</a>
                    </li>
                    <li class="paginate_button page-item disabled"
                        v-if="paginationStatus('right-dot')">
                      <span class="page-link">...</span>
                    </li>
                    <li class="paginate_button page-item"
                        :class="{active: pagination.page === pagination.totalPage - 4}"
                        v-if="paginationStatus('right-5')">
                      <span v-if="pagination.page === pagination.totalPage - 4"
                            class="page-link">{{ pagination.totalPage - 4 }}</span>
                      <a v-else href="#" class="page-link"
                         @click="pagination.page = pagination.totalPage - 4">{{ pagination.totalPage - 4 }}</a>
                    </li>
                    <li class="paginate_button page-item"
                        :class="{active: pagination.page === pagination.totalPage - 3}"
                        v-if="paginationStatus('right-4')">
                      <span v-if="pagination.page === pagination.totalPage - 3"
                            class="page-link">{{ pagination.totalPage - 3 }}</span>
                      <a v-else href="#" class="page-link"
                         @click="pagination.page = pagination.totalPage - 3">{{ pagination.totalPage - 3 }}</a>
                    </li>
                    <li class="paginate_button page-item"
                        :class="{active: pagination.page === pagination.totalPage - 2}"
                        v-if="paginationStatus('right-3')">
                      <span v-if="pagination.page === pagination.totalPage - 2"
                            class="page-link">{{ pagination.totalPage - 2 }}</span>
                      <a v-else href="#" class="page-link"
                         @click="pagination.page = pagination.totalPage - 2">{{ pagination.totalPage - 2 }}</a>
                    </li>
                    <li class="paginate_button page-item"
                        :class="{active: pagination.page === pagination.totalPage - 1}"
                        v-if="paginationStatus('right-2')">
                      <span v-if="pagination.page === pagination.totalPage - 1"
                            class="page-link">{{ pagination.totalPage - 1 }}</span>
                      <a v-else href="#" class="page-link"
                         @click="pagination.page = pagination.totalPage - 1">{{ pagination.totalPage - 1 }}</a>
                    </li>
                    <li class="paginate_button page-item"
                        :class="{active: pagination.page === pagination.totalPage}"
                        v-if="paginationStatus('right-1')">
                      <span v-if="pagination.page === pagination.totalPage"
                            class="page-link">{{ pagination.totalPage }}</span>
                      <a v-else href="#" class="page-link"
                         @click="pagination.page = pagination.totalPage">{{ pagination.totalPage }}</a>
                    </li>
                    <li class="paginate_button page-item next"
                        :class="{'disabled': pagination.page >= pagination.totalPage}">
                      <a href="#" class="page-link" @click="pagination.page += 1">
                        <i class="icon-keyboard_arrow_right"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </admin-layout>
</template>

<script>
import { Base64 } from 'js-base64';
import AdminLayout from "./SiteMain";
import SitePageActions from "./SitePageActions";
import GridActions from "../Grid/Actions";
import GridBreadcrumbs from "../Grid/Breadcrumbs";
import GridFilter from "../Grid/Filter";
import GridFilterPanel from "../Grid/FilterPanel";
import BootstrapSelect from "../Module/BootstrapSelect";

export default {
  name: "BaseIndex",
  components: {
    AdminLayout,
    SitePageActions,
    GridActions,
    GridBreadcrumbs,
    GridFilter,
    GridFilterPanel,
    BootstrapSelect
  },
  props: {
    urls: Object,
    configs: Object,
  },
  data() {
    return {
      breadcrumbs: [],
      gridBreadcrumbs: [],
      trans: {},
      search: [],
      options: {},
      columns: [],
      values: [],
      advanceFilter: null,
      advanceFilters: [],
      prepared: false,
      currentSelected: [],
      currentKeyword: null,
      currentSearch: 'all',
      currentFilter: {},
      currentAdvanceFilter: {
        id: null,
        title: null,
        editable: false,
        deletable: false,
        conditions: []
      },
      currentSorting: [],
      pagination: {
        baseAmount: 0,
        totalAmount: 0,
        totalPage: 1,
        page: 1,
        perPage: 20,
      }
    }
  },
  created() {
    this.getUI();
  },
  watch: {
    currentKeyword: function () {
      this.renderGrid();
    },
    currentSearch: function () {
      this.renderGrid();
    },
    currentFilter: {
      handler: function (afterVal, beforeVal) {
        if (JSON.stringify(afterVal) !== JSON.stringify(beforeVal)) {
          this.renderGrid();
        }
      },
      deep: true
    },
    currentAdvanceFilter: {
      handler: function (afterVal, beforeVal) {
        if (JSON.stringify(afterVal) !== JSON.stringify(beforeVal)) {
          this.renderGrid();
        }
      },
      deep: true
    },
    currentSorting: {
      handler: function () {
        this.renderGrid();
      },
      deep: true
    },
    "pagination.page": function (afterVal) {
      if (afterVal < 1) {
        this.pagination.page = 1;
      } else if (afterVal > this.pagination.totalPage) {
        this.pagination.page = this.pagination.totalPage;
      } else if (this.pagination.perPage === -1 && this.pagination.page !== 1) {
        this.pagination.page = 1;
      } else {
        this.renderGrid();
      }
    },
    "pagination.perPage": function () {
      this.renderGrid();
    }
  },
  computed: {
    bindSearch: function () {
      let searchOptions = [];
      for (let i in this.search) {
        if (this.search.hasOwnProperty(i)) {
          searchOptions.push({
            value: this.array_get(this.search, i + '.value'),
            label: this.search[i].hasOwnProperty('label')
              ? this.array_get(this.search, i + '.label')
              : this.array_get(this.trans, this.array_get(this.search, i + '.label_key'))
          });
        }
      }
      return searchOptions;
    },
    filters: function () {
      let filters = [];
      for (let column in this.options) {
        if (this.options.hasOwnProperty(column) && this.options[column].filterable) {
          let filter = {column: column, options: [
              {label: this.options[column].label, value: null},
              ...this.options[column].options
            ]};
          filters.push(filter);
        }
      }
      return filters;
    },
    rowStart: function () {
      if (this.pagination.totalAmount < 1) {
        return 0;
      }

      if (this.pagination.perPage === -1) {
        return 1;
      }

      return this.pagination.perPage * ((this.pagination.page < 1 ? 1 : this.pagination.page) - 1) + 1;
    },
    rowEnd: function () {
      if (this.pagination.perPage === -1) {
        return this.pagination.totalAmount;
      }

      let endRow = this.pagination.page * this.pagination.perPage;
      return endRow > this.pagination.totalAmount ? this.pagination.totalAmount : endRow;
    },
    perPageList: function () {
      return [
        {value: 10, label: '10'},
        {value: 20, label: '20'},
        {value: 50, label: '50'},
        {value: 100, label: '100'},
        {value: 150, label: '150'},
        {value: -1, label: this.array_get(this.trans, 'ui.grid.page_all')},
      ];
    },
    paginationInfo: function () {
      let text = this.array_get(this.trans, 'ui.grid.pagination_info');
      if (this.blank(text)) {
        return null;
      }

      return text
        .replace(':start', this.rowStart)
        .replace(':end', this.rowEnd)
        .replace(':total', this.pagination.totalAmount);
    },
    filterInfo: function () {
      let text = this.array_get(this.trans, 'ui.grid.filter_info');
      if (this.blank(text)) {
        return null;
      }

      return text.replace(':total', this.pagination.baseAmount);
    }
  },
  methods: {
    getUI: function () {
      axios
        .get(this.urls.api_ui)
        .then((response) => {
          this.breadcrumbs = response.data.data.breadcrumbs;
          this.gridBreadcrumbs = this.filled(response.data.data.gridBreadcrumbs)
            ? response.data.data.gridBreadcrumbs : [];
          this.trans = response.data.data.trans;
          this.columns = response.data.data.columns;
          this.search = response.data.data.searches;
          this.options = response.data.data.options;
          this.advanceFilter = response.data.data.advance_filter;
          this.advanceFilters = response.data.data.advance_filters;
          this.getFilter();
          this.$nextTick(function () {
            window.dispatchEvent(new Event('resize'));
          });
        });
    },
    getFilter: function () {
      axios
        .post(this.urls.api_filter)
        .then((response) => {
          this.currentKeyword = response.data.data.keyword;
          this.currentSearch = response.data.data.search;
          this.currentFilter = response.data.data.filter;
          this.currentAdvanceFilter = response.data.data.advance_filter;
          this.currentSorting = response.data.data.sorting;
          this.pagination.page = response.data.data.page;
          this.pagination.perPage = response.data.data.per_page;
          setTimeout(() => {
            this.prepared = true;
            this.renderGrid();
          }, 100);
        });
    },
    withSortingClass: function (column, baseClass) {
      let sortingClass = 'sorting';
      for (let i in this.currentSorting) {
        if (this.array_get(this.currentSorting, i + '.0') === column) {
          sortingClass = 'sorting_' + this.array_get(this.currentSorting, i + '.1');
        }
      }
      if (this.filled(baseClass)) {
        return baseClass.concat([sortingClass]);
      }
      return [sortingClass];
    },
    renderGrid: function () {
      if (!this.prepared) {
        return;
      }

      const urlParams = new URLSearchParams(window.location.search);

      axios
        .post(this.urls.api_grid, {
          page: this.pagination.page,
          per_page: this.pagination.perPage,
          filters: {
            search: this.currentSearch,
            keyword: this.currentKeyword,
            filters: this.currentFilter,
            advance_filter_id: this.currentAdvanceFilter.id,
            advance_filters: this.currentAdvanceFilter.conditions
          },
          sorting: this.currentSorting,
          parent: urlParams.get('parent')
        })
        .then((response) => {
          this.values = response.data.data.data;
          this.pagination.baseAmount = response.data.data.base_amount;
          this.pagination.totalAmount = response.data.data.total_amount;
          this.pagination.totalPage = response.data.data.total_page;
          this.pagination.page = response.data.data.page;
          this.pagination.perPage = response.data.data.per_page;
        });
    },
    allSelected: function () {
      return this.filled(this.currentSelected) && this.values.length === this.currentSelected.length;
    },
    allSelectSwitch: function (event) {
      let allRowId = [];
      if (event.target.checked) {
        for (let i in this.values) {
          allRowId.push(this.array_get(this.values, i + '.id'));
        }
      }
      this.currentSelected = allRowId;
    },
    switchSelected: function (event) {
      if (event.target.checked) {
        this.currentSelected.push(event.target.value);
      } else {
        this.currentSelected.splice(this.currentSelected.indexOf(event.target.value), 1);
      }
    },
    addSorting: function (event, column) {
      event.preventDefault();
      let isExists = (item) => item[0] === column;
      let existsKey = this.currentSorting.findIndex(isExists);

      if (event.shiftKey) {
        if (existsKey === -1) {
          this.currentSorting.push([column, 'asc']);
        } else {
          let direction = this.currentSorting[existsKey][1] === 'desc'
            ? 'asc' : 'desc';
          this.currentSorting.splice(existsKey, 1);
          this.currentSorting.push([column, direction]);
        }
      } else {
        let direction = existsKey === -1 || this.currentSorting[existsKey][1] === 'desc'
          ? 'asc' : 'desc';
        this.currentSorting = [[column, direction]];
      }
      document.getSelection().removeAllRanges();
    },
    redirectWithFilter: function (conditions) {
      let filterId = null;
      let filterConditions = null;

      if (typeof conditions === "string" || typeof conditions === "number") {
        filterId = conditions;
      } else {
        if (this.filled(this.currentAdvanceFilter.id)) {
          filterId = this.currentAdvanceFilter.id;
        }
        filterConditions = conditions;
      }

      let paramSet = {};
      if (this.filled(filterId)) {
        paramSet.id = filterId;
      }
      if (this.filled(filterConditions)) {
        paramSet.conditions = filterConditions;
      }

      let param = this.blank(paramSet) ? '' : ('filter=' + encodeURIComponent(Base64.encode(JSON.stringify(paramSet))));
      let url = window.location.href;
      let urlParams = new URLSearchParams(window.location.search);

      if (urlParams.has('filter')) {
        url = url
          .replace('filter=' + urlParams.get('filter'), param)
          .replace('filter=' + encodeURIComponent(urlParams.get('filter')), param);
      } else if (this.filled(param)) {
        url = (this.blank(window.location.search) ? '?' : '&') + param;
      }

      location.href = url;
    },
    paginationStatus: function (code) {
      let pagination = this.pagination;
      let total = pagination.totalPage, page = pagination.page;

      if (total <= 1) {
        return code === 'left-1';
      } else if (total <= 7) {
        return ['left-1', 'left-2', 'left-3', 'left-4', 'left-5', 'right-2', 'right-1'].splice(0, total).includes(code);
      }

      if (page < 5) {
        return ['left-1', 'left-2', 'left-3', 'left-4', 'left-5', 'right-dot', 'right-1'].includes(code);
      } else if (page > (total - 4)) {
        return ['left-1', 'left-dot', 'right-5', 'right-4', 'right-3', 'right-2', 'right-1'].includes(code);
      }

      return ['left-1', 'left-dot', 'mid-left', 'mid-center', 'mid-right', 'right-dot', 'right-1'].includes(code);
    }
  }
}
</script>
