<template>
  <div class="form-row">
    <div class="col-auto mb-2">
      <bootstrap-select
        id="filter-collection-rule_type"
        class="form-control bs-select"
        data-style="btn-outline-secondary"
        :options="ruleTypes"
        :value="rule_type"
        v-on:input="rule_type = $event" />
    </div>
    <div class="col-auto mb-2">
      <bootstrap-select
        id="filter-collection-operation"
        class="form-control bs-select"
        data-style="btn-outline-secondary"
        :options="operations"
        :value="operation"
        v-on:input="operation = $event" />
    </div>
    <div class="col-auto mb-2" v-if="operation !== 'empty'">
      <bootstrap-select
        id="filter-collection-values"
        class="form-control bs-select"
        data-style="btn-outline-secondary"
        data-size="6"
        data-action-box="true"
        :title="array_get(trans, 'ui.filter.please_select')"
        :data-live-search="options.length > 6"
        :data-none-results-text="array_get(trans, 'ui.filter.no_result_matched')"
        :options="options"
        :value="currentValue"
        v-on:input="currentValue = $event"
        multiple />
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
  name: "Collection",
  components: {
    BootstrapSelect
  },
  props: ['trans', 'configs'],
  data() {
    return {
      rule_type: 'positive',
      operation: 'any',
      values: []
    }
  },
  computed: {
    options: function () {
      if (!this.configs.hasOwnProperty('options') || this.blank(this.configs.options)) {
        return [];
      }
      return this.configs.options;
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
          {'value': 'any', 'label': this.array_get(this.trans, 'ui.filter.operation.any')},
          {'value': 'all', 'label': this.array_get(this.trans, 'ui.filter.operation.all')},
          {'value': 'empty', 'label': this.array_get(this.trans, 'ui.filter.operation.empty')}
        ];
    },
    currentValue: {
      get: function () {
        return this.blank(this.values) ? [] : this.values;
      },
      set: function (values) {
        if (JSON.stringify(values) !== JSON.stringify(this.values)) {
          this.values = Array.isArray(values) ? values : [];
        }
      }
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
          "values": this.values
        })));

      this.initValues();
    },
    initValues: function () {
      this.rule_type = 'positive';
      this.operation = 'any';
      this.values = [];
    }
  }
}
</script>
