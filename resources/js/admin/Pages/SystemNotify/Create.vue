<template>
  <base-create :urls="urls" :configs="configs" ref="baseCreate">
    <fieldset v-for="(columns, fieldSet, index) in baseCreate.columns" :class="{'mt-4': index > 0}">
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
        @click="getData">
        {{ array_get(trans, 'ui.button.reset') }}</button>
    </div>
  </base-create>
</template>

<script>
import CommonCreate from "../Common/Create";

export default {
  extends: CommonCreate,
  name: "SystemNotifyCreate",
  data() {
    return {
      currentPanel: 'user_mail'
    }
  },
  methods: {
    getTabs: function () {
      return ['user_mail', 'admin_mail', 'user_sms', 'admin_sms'];
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
        configs.options.options = this.getOptions(this.array_get(configs, 'options.options'), this.baseCreate.options);
      }

      return configs;
    }
  }
}
</script>
