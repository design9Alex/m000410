<template>
  <div class="table-toolbar row">
    <div class="col-md-auto">
      <div class="row no-gutters">
        <label class="col-auto mr-2">
          <i class="icon-search i-o align-middle h3 mb-0 p-0"></i>{{ array_get(trans, 'ui.filter.search') }}
        </label>
        <div class="col col-md-auto mr-1">
          <input
            class="form-control form-control-sm table-search-input"
            type="search"
            :value="currentKeyword"
            @search="$emit('input', $event.target.value)"
            @change="$emit('input', $event.target.value)" />
        </div>
        <div class="col-auto mr-1">
          <bootstrap-select
            class="form-control bs-select min-w-select"
            data-style="btn-outline-secondary btn-sm"
            :value="currentSearch"
            :options="search"
            v-on:input="$emit('change', $event)" />
        </div>
      </div>
    </div>
    <div class="col-md" v-if="filled(filters) || filled(advanceFilters)">
      <div class="row no-gutters justify-content-md-end text-nowrap my-1 my-md-0">
        <label class="col-auto mr-1">
          <i class="icon-narrow i-o align-middle h3 mb-0 p-0"></i>{{ array_get(trans, 'ui.filter.filter') }}
        </label>

        <div class="col col-md-auto ml-1" v-if="filled(advanceFilters)">
          <bootstrap-select
            class="form-control bs-select"
            data-style="btn-outline-secondary btn-sm"
            data-container="body > div.wrapper > div.page-content > div.content-body"
            :key="'advance-filter-list'"
            :title="array_get(trans, 'ui.filter.custom_filter')"
            :data-live-search="advanceFilters.length > 6"
            :group="true"
            :value="array_get(currentAdvanceFilter, 'id')"
            :options="advanceFilters"
            v-on:input="updateAdvanceFilter($event)" />
        </div>

        <div class="col col-md-auto ml-1" v-for="filter in filters">
          <bootstrap-select
            class="form-control bs-select"
            data-style="btn-outline-secondary btn-sm"
            data-container="body > div.wrapper > div.page-content > div.content-body"
            :key="filter.column"
            :data-live-search="filter.options.length > 6"
            :value="array_get(currentFilter, filter.column)"
            :options="filter.options"
            v-on:input="updateFilters(filter.column, $event)" />
        </div>

        <grid-advance-filter
          v-if="filled(advanceFilterUi)"
          :trans="trans"
          :options="options"
          :advanceFilterUi="advanceFilterUi"
          :currentAdvanceFilter="currentAdvanceFilter"
          v-on:update="updateAdvanceFilters($event)"/>
      </div>
    </div>
  </div>
</template>

<script>
import BootstrapSelect from "../Module/BootstrapSelect";
import GridAdvanceFilter from "../Grid/AdvanceFilter";

export default {
  name: "GridFilter",
  components: {
    BootstrapSelect,
    GridAdvanceFilter
  },
  props: {
    trans: Object,
    options: Object,
    search: Array,
    filters: Array,
    advanceFilterUi: Object,
    advanceFilters: Array,
    currentKeyword: String,
    currentSearch: String,
    currentFilter: Object,
    currentAdvanceFilter: Object
  },
  methods: {
    updateFilters: function (column, value) {
      let thisFilter = JSON.parse(JSON.stringify(this.currentFilter));
      thisFilter[column] = value;
      this.$emit('filter', thisFilter);
    },
    updateAdvanceFilter: function (id) {
      this.$emit('advanceFilter', id);
    },
    updateAdvanceFilters: function (conditions) {
      this.$emit('advanceFilters', conditions);
    }
  }
}
</script>
