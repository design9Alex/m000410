<template>
  <div class="form-row">
    <div class="col-auto mb-2">
      <bootstrap-select
        id="filter-datetime-rule_type"
        class="form-control bs-select"
        data-style="btn-outline-secondary"
        :options="ruleTypes"
        :value="rule_type"
        v-on:input="rule_type = $event" />
    </div>
    <div class="col-auto mb-2">
      <bootstrap-select
        id="filter-datetime-operation"
        class="form-control bs-select"
        data-size="6"
        data-style="btn-outline-secondary"
        :options="operations"
        :value="operation"
        v-on:input="operation = $event" />
    </div>
    <div class="col-auto mb-2" v-if="module_set === 'datetime'">
      <date-picker
        input-class="form-control"
        type="datetime"
        format="YYYY-MM-DD HH:mm:ss"
        value-type="format"
        :lang="uiLang"
        :value="datetime"
        v-on:input="datetime = $event"
        v-on:change="datetime = $event" />
    </div>
    <div class="col-auto mb-2" v-if="module_set === 'amount'">
      <input class="form-control" type="text" v-model="amount" />
    </div>
    <div class="col-auto mb-2" v-if="module_set === 'amount'">
      <bootstrap-select
        id="filter-datetime-unit"
        class="form-control bs-select"
        data-style="btn-outline-secondary"
        :options="units"
        :value="unit"
        v-on:input="unit = $event" />
    </div>
    <div class="col-auto mb-2">
      <button class="btn btn-primary" type="button" @click="pushCondition">
        <i class="icon-plus"></i>
      </button>
    </div>
  </div>
</template>

<script>
import BootstrapSelect from "../../Module/BootstrapSelect";
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/locale/zh-tw';
import 'vue2-datepicker/locale/zh-cn';
import 'vue2-datepicker/locale/en';
import 'vue2-datepicker/locale/ja';

export default {
  name: "Datetime",
  components: {
    BootstrapSelect,
    DatePicker
  },
  props: ['trans', 'configs'],
  data() {
    return {
      rule_type: 'positive',
      operation: 'equal',
      datetime: null,
      amount: null,
      unit: 'day',
      defaultOptions: {
      }
    }
  },
  computed: {
    options: function () {
      if (!this.configs.hasOwnProperty('options') || this.blank(this.configs.options)) {
        return this.defaultOptions;
      }
      return {...this.defaultOptions, ...this.configs.options}
    },
    uiLang: function () {
      switch (document.documentElement.lang) {
        case 'zh-TW':
          return 'zh-tw';
        case 'zh-CN':
          return 'zh-cn';
        case 'ja':
          return 'ja';
        default:
          return 'en';
      }
    },
    ruleTypes: function () {
      return this.blank(this.trans) ? []
        : [
          {'value': 'positive', 'label': this.array_get(this.trans, 'ui.filter.rule_type.positive')},
          {'value': 'negative', 'label': this.array_get(this.trans, 'ui.filter.rule_type.negative')}
        ];
    },
    operations: function () {
      return this.blank(this.trans) ? []
        : [
          {'value': 'equal', 'label': this.array_get(this.trans, 'ui.filter.operation.equal')},
          {'value': 'greater', 'label': this.array_get(this.trans, 'ui.filter.operation.greater')},
          {'value': 'lesser', 'label': this.array_get(this.trans, 'ui.filter.operation.lesser')},
          {'value': 'greater-equal', 'label': this.array_get(this.trans, 'ui.filter.operation.greater-equal')},
          {'value': 'lesser-equal', 'label': this.array_get(this.trans, 'ui.filter.operation.lesser-equal')},
          {'value': 'past-after', 'label': this.array_get(this.trans, 'ui.filter.operation.past-after')},
          {'value': 'past-after-now', 'label': this.array_get(this.trans, 'ui.filter.operation.past-after-now')},
          {'value': 'past-before', 'label': this.array_get(this.trans, 'ui.filter.operation.past-before')},
          {'value': 'future-before', 'label': this.array_get(this.trans, 'ui.filter.operation.future-before')},
          {'value': 'future-before-now', 'label': this.array_get(this.trans, 'ui.filter.operation.future-before-now')},
          {'value': 'future-after', 'label': this.array_get(this.trans, 'ui.filter.operation.future-after')},
          {'value': 'today', 'label': this.array_get(this.trans, 'ui.filter.operation.today')},
          {'value': 'week', 'label': this.array_get(this.trans, 'ui.filter.operation.week')},
          {'value': 'month', 'label': this.array_get(this.trans, 'ui.filter.operation.month')},
          {'value': 'quarter', 'label': this.array_get(this.trans, 'ui.filter.operation.quarter')},
          {'value': 'year', 'label': this.array_get(this.trans, 'ui.filter.operation.year')},
          {'value': 'empty', 'label': this.array_get(this.trans, 'ui.filter.operation.empty')}
        ];
    },
    units: function () {
      return this.blank(this.trans) ? []
        : [
          {'value': 'day', 'label': this.array_get(this.trans, 'ui.filter.unit.day')},
          {'value': 'week', 'label': this.array_get(this.trans, 'ui.filter.unit.week')},
          {'value': 'month', 'label': this.array_get(this.trans, 'ui.filter.unit.month')},
          {'value': 'quarter', 'label': this.array_get(this.trans, 'ui.filter.unit.quarter')},
          {'value': 'year', 'label': this.array_get(this.trans, 'ui.filter.unit.year')}
        ];
    },
    module_set: function () {
      switch (this.operation) {
        case 'today':
        case 'week':
        case 'month':
        case 'quarter':
        case 'year':
        case 'empty':
          return 'selection';
        case 'equal':
        case 'greater':
        case 'lesser':
        case 'greater-equal':
        case 'lesser-equal':
          return 'datetime';
        case 'past-after':
        case 'past-after-now':
        case 'past-before':
        case 'future-before':
        case 'future-before-now':
        case 'future-after':
          return 'amount';
      }
      return null;
    }
  },
  methods: {
    pushCondition: function () {
      let condition;

      switch (this.module_set) {
        case 'selection':
          condition = {
            "rule_type": this.rule_type,
            "operation": this.operation
          };
          break;
        case 'datetime':
          condition = {
            "rule_type": this.rule_type,
            "operation": this.operation,
            "datetime": this.datetime
          }
          break;
        case 'amount':
          condition = {
            "rule_type": this.rule_type,
            "operation": this.operation,
            "amount": this.amount,
            "unit": this.unit
          }
          break;
        default:
          condition = {
            "rule_type": this.rule_type,
            "operation": 'empty'
          }
          break;
      }

      this.$emit('push', JSON.parse(JSON.stringify(condition)));

      this.initValues();
    },
    initValues: function () {
      this.rule_type = 'positive';
      this.operation = 'equal';
      this.datetime = null;
      this.amount = null;
      this.unit = 'day';
    }
  }
}
</script>
