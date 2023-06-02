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

          <template v-else-if="column.component === 'grid-subject'">
            <h3 class="h6 d-inline d-sm-block">{{ rowValue.subject }}</h3>
            <p class="m-0 p-0"><small>{{ rowValue.content }}</small></p>
            <small class="text-success float-right">{{ rowValue.receiver }}</small>
          </template>

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
import CommonIndex from "../Common/Index";

export default {
  extends: CommonIndex,
  name: "InboxSentIndex",
}
</script>
