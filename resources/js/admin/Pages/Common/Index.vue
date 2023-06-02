<template>
  <base-index :urls="urls" :configs="configs" ref="baseIndex">
    <template v-slot:buttons="slotButtons">
      <site-page-actions :urls="urls" :trans="trans">
        <site-page-batch
          :urls="urls"
          :trans="trans"
          :current-selected="slotButtons.currentSelected"
          v-on:batched="slotButtons.renderGrid()" />
      </site-page-actions>
    </template>

    <template v-slot:grid-head="slotGridHead">
      <tr>
        <th
          v-for="column in baseIndex.columns"
          v-if="columnCondition(column)"
          :class="column.sortable ? baseIndex.withSortingClass(column.key, column.class) : column.class"
          @click="column.sortable ? baseIndex.addSorting($event, column.key) : null">
          <grid-all-marker
            v-if="column.component === 'grid-row-marker'"
            :trans="trans"
            :status="baseIndex.allSelected()"
            v-on:click="baseIndex.allSelectSwitch($event)" />
          <template v-else-if="column.component === 'grid-actions'">
            {{ array_get(trans, 'ui.grid.actions') }}
          </template>
          <template v-else>
            {{ array_get(trans, 'module.' + column.key) }}
          </template>
        </th>
      </tr>
    </template>

    <template v-slot:grid-rows="slotGridRows">
      <tr v-for="(rowValue, rowIndex) in baseIndex.values" :key="'grid_' + rowIndex">
        <td
          v-for="column in baseIndex.columns"
          v-if="columnCondition(column)"
          :class="column.gridClass">

          <grid-row-marker
            v-if="column.component === 'grid-row-marker'"
            :value="rowValue[column.key]"
            :status="baseIndex.currentSelected.indexOf(rowValue[column.key]) !== -1"
            v-on:click="baseIndex.switchSelected($event)" />

          <component
            v-else
            :is="column.component"
            :key="'grid_' + rowIndex + '_' + column.key"
            :trans="trans"
            :value="rowValue[column.key]"
            :configs="getComponentConfigs(column)"
            v-on:changed="baseIndex.renderGrid()"></component>

        </td>
      </tr>
    </template>
  </base-index>
</template>

<script>
import BaseIndex from "../../Components/Layout/BaseIndex";
import SitePageActions from "../../Components/Layout/SitePageActions";
import SitePageBatch from "../../Components/Layout/SitePageBatch";
import GridActions from "../../Components/Grid/Actions";
import GridAllMarker from "../../Components/Grid/AllMarker";
import GridCollection from "../../Components/Grid/Collection";
import GridLink from "../../Components/Grid/Link";
import GridPlaintext from "../../Components/Grid/Plaintext";
import GridRowMarker from "../../Components/Grid/RowMarker";
import GridSelection from "../../Components/Grid/Selection";
import GridSorter from "../../Components/Grid/Sorter";
import GridSwitcher from "../../Components/Grid/Switcher";
import {Base64} from "js-base64";

export default {
  name: "CommonIndex",
  components: {
    BaseIndex,
    SitePageActions,
    SitePageBatch,
    GridActions,
    GridAllMarker,
    GridCollection,
    GridLink,
    GridPlaintext,
    GridRowMarker,
    GridSelection,
    GridSorter,
    GridSwitcher
  },
  props: {
    urls: Object,
    configs: Object
  },
  computed: {
    baseIndex: {
      get: function () {
        if (this.$refs.baseIndex) {
          return this.$refs.baseIndex;
        }

        return {};
      },
      cache: false
    },
    trans: {
      get: function () {
        if (this.baseIndex.trans) {
          return this.baseIndex.trans;
        }
        return {};
      },
      cache: false
    }
  },
  methods: {
    getComponentConfigs: function (column) {
      if (this.blank(column.configs)) {
        return {};
      }

      let configs = JSON.parse(JSON.stringify(column.configs));

      configs.key = column.key;

      if (typeof this.array_get(configs, 'options') === 'string') {
        configs.options = this.array_get(this.baseIndex.options, column.key + '.options', []);
      }

      if (this.filled(this.array_get(configs, 'methods'))) {
        for (let name in configs.methods) {
          configs.methods[name] = this[configs.methods[name]];
        }
      }

      return configs;
    },
    columnCondition: function (column) {
      let condition = column.condition;

      if (this.blank(condition)) {
        return true;
      }

      if (typeof condition === 'boolean') {
        return condition;
      }

      if (typeof condition === 'string') {
        return eval(Base64.decode(condition));
      }

      return false;
    }
  }
}
</script>
