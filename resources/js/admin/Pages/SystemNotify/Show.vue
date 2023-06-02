<template>
  <base-show :urls="urls" :configs="configs" ref="baseShow">
    <fieldset v-for="(columns, fieldSet, index) in baseShow.columns" :class="{'mt-4': index > 0}">
      <legend class="legend h6 mb-4">
        <i class="icon-angle-double-down2 mr-2"></i>{{ array_get(trans, 'ui.legend.' + fieldSet) }}</legend>

      <template v-if="fieldSet === 'configs'">
        <div class="panel-wrapper">
          <div class="panel-body m-0 p-0">
            <header class="mb-4">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" v-for="tab in getTabs()" :key="'tab_' + tab">
                  <a class="nav-link" href="javascript:void(0)"
                     :class="currentPanel === tab ? ['show', 'active'] : []" role="tab"
                     @click="currentPanel = tab">
                    {{ array_get(trans, 'ui.button.' + tab) }}
                  </a>
                </li>
              </ul>
            </header>
            <div class="tab-content">
              <div class="tab-pane fade"  v-for="tab in getTabs()" :key="'panel_' + tab"
                   :class="currentPanel === tab ? ['show', 'active'] : []" role="tabpanel">
                <template v-for="column in getTabColumns(columns, tab)">

                  <template v-if="column.hasOwnProperty('children') && columnCondition(column)">

                    <component
                      v-for="subColumn in column.children"
                      v-if="columnCondition(subColumn)"
                      :is="subColumn.component"
                      :key="'field_' + tab + '_' + subColumn.key"
                      :trans="trans"
                      :configs="getSubComponentConfigs(subColumn, column.key, tab)"
                      v-model="liveValues[column.key][tab.split('_')[0]][subColumn.key]"></component>

                  </template>

                  <component
                    v-else-if="columnCondition(column)"
                    :is="column.component"
                    :key="'field_' + column.key"
                    :trans="trans"
                    :configs="getComponentConfigs(column)"
                    v-model="liveValues[column.key]"></component>

                </template>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group row" v-if="filled(liveValues.tags)">
          <div class="col-sm-10 offset-sm-2">
            <div class="note note-edfault mt-3">
              <h6 class="font-weight-bold">{{ array_get(trans, 'ui.topic.tags') }}</h6>
              <small class="text-pre-line" v-for="tag in liveValues.tags">
                <code class="mr-2">{[{{ tag.key }}]}</code>{{ tag.value }}
              </small>
            </div>
          </div>
        </div>
      </template>

      <template v-else>

        <component
          v-for="column in columns"
          v-if="columnCondition(column)"
          :is="column.component"
          :key="'field_' + column.key"
          :trans="trans"
          :configs="getComponentConfigs(column)"
          v-model="liveValues[column.key]"></component>

      </template>

    </fieldset>
  </base-show>
</template>

<script>
import CommonShow from "../Common/Show";

export default {
  extends: CommonShow,
  name: "SystemNotifyShow",
  data() {
    return {
      currentPanel: 'user_mail'
    }
  },
  methods: {
    getTabs: function () {
      let allTabs = ['user_mail', 'admin_mail', 'user_sms', 'admin_sms'];

      if (this.configs.super) {
        return allTabs;
      }

      let tabs = [];

      if (this.filled(this.baseShow.columns)) {
        let configColumns = this.baseShow.columns.configs;
        if (this.filled(configColumns)) {
          for (let index in allTabs) {
            let conditions = allTabs[index].split('_');
            let guardTest = new RegExp('_' + conditions[0] + '$', 'i');
            let typeTest = new RegExp('^' + conditions[1], 'i');

            for (let row in configColumns) {
              if ((guardTest.test(configColumns[row].key) && typeTest.test(configColumns[row].key))
                || configColumns[row].key === (conditions[1] + '_contents')) {
                if (tabs.indexOf(allTabs[index]) === -1) {
                  tabs.push(allTabs[index]);
                }
              }
            }
          }
        }
      }

      return tabs;
    },
    getTabColumns: function (columns, tab) {
      let tabColumns = [];
      let conditions = tab.split('_');
      let guardTest = new RegExp('_' + conditions[0] + '$', 'i');
      let typeTest = new RegExp('^' + conditions[1], 'i');

      for (let index in columns) {
        if ((guardTest.test(columns[index].key) && typeTest.test(columns[index].key))
          || columns[index].key === (conditions[1] + '_contents')) {
          tabColumns.push(columns[index]);
        }
      }

      return tabColumns;
    },
    getSubComponentConfigs: function (column, parent_key, tab) {
      let configs = JSON.parse(JSON.stringify(column.configs));
      let guard = tab.split('_')[0];

      configs.key = parent_key + '.' + guard + '.' + column.key;

      if (typeof this.array_get(configs, 'options.options') === 'string') {
        configs.options.options = this.getOptions(this.array_get(configs, 'options.options'), this.baseShow.options);
      }

      return configs;
    }
  }
}
</script>
