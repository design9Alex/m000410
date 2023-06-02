<template>
  <div class="form-row">
    <div class="col-auto mb-2">
      <bootstrap-select
        id="filter-keyword-rule_type"
        class="form-control bs-select"
        data-style="btn-outline-secondary"
        :options="ruleTypes"
        :value="rule_type"
        v-on:input="rule_type = $event" />
    </div>
    <div class="col-auto mb-2">
      <bootstrap-select
        id="filter-keyword-operation"
        class="form-control bs-select"
        data-style="btn-outline-secondary"
        :options="operations"
        :value="operation"
        v-on:input="operation = $event" />
    </div>
    <div class="col-auto mb-2" v-if="operation !== 'empty'">
      <input class="form-control" type="text" v-model="keyword" />
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
  name: "Keyword",
  components: {
    BootstrapSelect
  },
  props: ['trans', 'configs'],
  data() {
    return {
      rule_type: 'positive',
      operation: 'equal',
      keyword: null,
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
          {'value': 'include', 'label': this.array_get(this.trans, 'ui.filter.operation.include')},
          {'value': 'empty', 'label': this.array_get(this.trans, 'ui.filter.operation.empty')}
        ];
    }
  },
  methods: {
    pushCondition: function () {
      this.$emit('push', JSON.parse(JSON.stringify(this.operation === 'empty'
        ? {
          "special": this.array_get(this.configs, 'special'),
          "rule_type": this.rule_type,
          "operation": this.operation
        }
        : {
          "special": this.array_get(this.configs, 'special'),
          "rule_type": this.rule_type,
          "operation": this.operation,
          "keyword": this.keyword
        })));

      this.initValues();
    },
    initValues: function () {
      this.rule_type = 'positive';
      this.operation = 'equal';
      this.keyword = null;
    }
  }
}
</script>
