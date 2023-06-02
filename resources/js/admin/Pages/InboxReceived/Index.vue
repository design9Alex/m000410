<template>
  <base-index :urls="urls" :configs="configs" ref="baseIndex">
    <template v-slot:slotSitePageActions>
      <a v-if="filled(urls.trashed)" class="btn btn-sm btn-main"
         :href="urls.trashed" :title="array_get(trans, 'ui.button.trashed')">
        <i class="icon-trash"></i><!--
        --><span class="ml-1 d-none d-md-inline-block">{{ array_get(trans, 'ui.button.trashed') }}</span>
      </a>
      <site-page-batch
        :urls="urls"
        :trans="trans"
        :current-selected="baseIndex.currentSelected"
        v-on:batched="baseIndex.renderGrid()" />
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

          <template v-else-if="column.component === 'grid-starred'">
            <a class="icon-star-full starred-switch"
               :class="rowValue[column.key].value ? ['text-main'] : ['text-muted']"
               href="#" style="text-decoration:none"
               @click="switchStarred($event, rowValue[column.key].url, rowValue[column.key].value)"></a>
          </template>

          <template v-else-if="column.component === 'grid-subject'">
            <h3 class="h6 d-inline d-sm-block">{{ rowValue.subject }}</h3>
            <p class="m-0 p-0 text-muted"><small>{{ rowValue.content }}</small></p>
            <small class="text-success float-right">{{ rowValue.name }}</small>
          </template>

          <template v-else-if="column.component === 'grid-serial' && filled(rowValue.relation_search)">
            {{ rowValue[column.key] }}
            (<a :href="rowValue.relation_search">{{ array_get(trans, 'module.relation_search') }}</a>)
          </template>
          <template v-else-if="column.component === 'grid-serial'">
            {{ rowValue[column.key] }}
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
  name: "InboxReceivedIndex",
  methods: {
    switchStarred: function ($event, url, value) {
      $event.preventDefault();

      if (this.filled(url)) {
        this.$swal({
          title: this.array_get(this.trans, 'ui.message.updating'),
          icon: 'info',
          showConfirmButton: false,
          allowOutsideClick: false
        });

        axios
          .put(url, {column: 'starred', value: !value})
          .then((response) => {
            if (response.data.code === '0000') {
              this.baseIndex.renderGrid();
              setTimeout(() => {this.$swal.close()}, 300);
            } else {
              this.$swal({text: response.data.message, icon: 'error'});
            }
          })
          .catch((error) => {
            this.$swal({text: error.response.data.message, icon: 'error'});
          });
      }
    },
    doRestore: function (url) {
      if (this.blank(url)) {
        return;
      }

      this.$swal({
        title: this.array_get(this.trans, 'ui.message.restoring'),
        icon: 'info',
        showConfirmButton: false,
        allowOutsideClick: false
      });

      axios
        .post(url)
        .then((response) => {
          if (response.data.code === '0000') {
            this.baseIndex.renderGrid();
            this.$swal.close();
          } else {
            this.$swal({text: response.data.message, icon: 'error'});
          }
        })
        .catch((error) => {
          this.$swal({text: error.response.data.message, icon: 'error'});
        });
    }
  }
}
</script>
