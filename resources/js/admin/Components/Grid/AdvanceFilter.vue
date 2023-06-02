<template>
  <div class="col col-md-auto ml-1">
    <button class="btn btn-warning btn-sm" type="button" @click="modalShow = true">
      <i class="icon-search"></i><!--
      --><span class="ml-1 d-none d-md-inline-block">{{ array_get(trans, 'ui.button.advance_filter') }}</span>
    </button>

    <div class="modal fade show"
         style="display: block;" role="dialog"
         v-if="modalShow"
         @click="hideModal($event)">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header bg-heading-1">
            <h5 class="modal-title">{{ array_get(trans, 'ui.topic.advance_filter') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" @click="modalShow = false">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <fieldset class="mt-4">
              <legend class="legend h6 mb-4">
                <i class="icon-angle-double-down2 mr-2"></i>{{ array_get(trans, 'ui.legend.filters') }}</legend>

              <div class="filterTag mb-3 position-relative pt-2 pl-2 pr-2" v-if="filled(custom.filters)">
                <grid-filter-tag
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
          </div>

          <div class="modal-footer">
            <button
              class="btn btn-secondary"
              type="button"
              @click="modalShow = false">{{ array_get(trans, 'ui.button.cancel') }}</button>
            <button
              class="btn btn-primary"
              type="button" @click="doFilter()">{{ array_get(trans, 'ui.button.apply') }}</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-backdrop fade show" v-if="modalShow"></div>
  </div>
</template>

<script>
import BootstrapSelect from "../Module/BootstrapSelect";
import FilterCollection from "../Form/Filter/Collection";
import FilterDate from "../Form/Filter/Date";
import FilterDatetime from "../Form/Filter/Datetime";
import FilterKeyword from "../Form/Filter/Keyword";
import FilterNumeric from "../Form/Filter/Numeric";
import GridFilterTag from "./FilterTag";

export default {
  name: "GridAdvanceFilter",
  components: {
    BootstrapSelect,
    FilterCollection,
    FilterDate,
    FilterDatetime,
    FilterKeyword,
    FilterNumeric,
    GridFilterTag
  },
  props: {
    trans: Object,
    options: Object,
    advanceFilterUi: Object,
    currentAdvanceFilter: Object
  },
  data() {
    return {
      modalShow: false,
      columns: [],
      custom: {
        filters: [],
        columns: [],
      },
      filterColumn: null,
    }
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
      for (let index in this.custom.columns) {
        if (this.custom.columns[index].key === this.filterColumn) {
          return this.custom.columns[index].component;
        }
      }
      return null;
    },
    currentConfigs: function () {
      let configs = {};

      for (let index in this.custom.columns) {
        if (this.custom.columns[index].key === this.filterColumn) {
          if (this.custom.columns[index].hasOwnProperty('configs')) {
            configs = JSON.parse(JSON.stringify(this.custom.columns[index].configs));
          }
          if (this.custom.columns[index].component === 'filter-collection') {
            configs.options = this.options[this.filterColumn].options;
          }
        }
      }

      return configs;
    },
    filterColumnOptions: function () {
      let columns = [];

      for (let index in this.custom.columns) {
        if (this.custom.columns[index].hasOwnProperty('component')) {
          columns.push({
            value: this.custom.columns[index].key,
            label: this.custom.columns[index].hasOwnProperty('label')
              ? this.custom.columns[index].label
              : this.array_get(this.trans, 'module.' + this.custom.columns[index].key),
          });
        }
      }

      return columns;
    },
  },
  watch: {
    modalShow: function (status) {
      if (status) {
        document.body.classList.add('modal-open');
      } else {
        document.body.classList.remove('modal-open');
      }
    },
    advanceFilterUi: {
      handler: function (value) {
        this.custom = value;
      },
      immediate: true,
      deep: true
    },
    currentAdvanceFilter: function (value) {
      this.custom.filters = JSON.parse(JSON.stringify(value.conditions));
    }
  },
  methods: {
    hideModal: function ($event) {
      let classes = $event.target.classList;
      if (classes.contains('modal')) {
        this.modalShow = false;
      }
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
    doFilter: function () {
      this.$emit('update', this.custom.filters);
      this.modalShow = false;
    }
  }
}
</script>
