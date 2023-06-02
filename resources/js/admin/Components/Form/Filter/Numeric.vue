<template>
  <div class="form-row">
    <div class="col-auto mb-2">
      <bootstrap-select
        id="filter-numeric-rule_type"
        class="form-control bs-select"
        data-style="btn-outline-secondary"
        :options="ruleTypes"
        :value="rule_type"
        v-on:input="rule_type = $event" />
    </div>
    <div class="col-auto mb-2">
      <bootstrap-select
        id="filter-numeric-operation"
        class="form-control bs-select"
        data-style="btn-outline-secondary"
        :options="operations"
        :value="operation"
        v-on:input="operation = $event" />
    </div>
    <div class="col-auto mb-2" v-if="operation !== 'empty'">
      <input class="form-control" type="text" v-model="number" />
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

export default {
  name: "Numeric",
  components: {
    BootstrapSelect
  },
  props: ['trans', 'configs'],
  data() {
    return {
      rule_type: 'positive',
      operation: 'equal',
      number: null,
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
          {'value': 'empty', 'label': this.array_get(this.trans, 'ui.filter.operation.empty')}
        ];
    }
  },
  methods: {
    pushCondition: function () {
      this.$emit('push', JSON.parse(JSON.stringify(this.operation === 'empty'
        ? {
          "rule_type": this.rule_type,
          "operation": this.operation
        }
        : {
          "rule_type": this.rule_type,
          "operation": this.operation,
          "number": this.number
        })));

      this.initValues();
    },
    initValues: function () {
      this.rule_type = 'positive';
      this.operation = 'equal';
      this.number = null;
    }
  }
}
</script>
