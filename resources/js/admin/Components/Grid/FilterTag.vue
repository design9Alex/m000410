<template>
  <button class="btn btn-light mb-2 mr-1 text-left" type="button" @click="$emit('click')">
    <i class="icon-cross mr-2 text-danger"></i><!--
    --><span class="text-muted">{{ column }} ({{ rule_type }})：</span><!--
    --><b class="text-dark" v-if="conditionText !== null">{{ conditionText }}</b>
  </button>
</template>

<script>
export default {
  name: "GridFilterTag",
  props: {
    "trans": Object,
    "filter": Object,
    "options": {
      type: Object,
      default: function () {
        return {};
      }
    }
  },
  computed: {
    column: function () {
      if (this.filled(this.trans) && this.filled(this.filter)) {
        return this.array_get(this.trans, 'module.' + this.filter.column);
      }
      return null;
    },
    rule_type: function () {
      if (this.filled(this.trans) && this.filled(this.filter)) {
        return this.array_get(this.trans, 'ui.filter.rule_type.' + this.filter.rule_type);
      }
      return null;
    },
    operation: function () {
      if (this.filled(this.trans) && this.filled(this.filter)) {
        return this.array_get(this.trans, 'ui.filter.operation.' + this.filter.operation).replace(/\([>=<]+\)/, '');
      }
      return null;
    },
    unit: function () {
      if (this.filled(this.trans) && this.filled(this.filter)) {
        return this.array_get(this.trans, 'ui.filter.unit.' + this.filter.unit);
      }
      return null;
    },
    collection: function () {
      let collectionText = '';
      if (this.filled(this.filter) && this.filled(this.filter.values)) {
        if (this.options.hasOwnProperty(this.filter.column)) {
          let options = this.options[this.filter.column].options;
          if (this.filled(options)) {
            for (let index in options) {
              if (this.filter.values.indexOf(options[index].value + '') !== -1) {
                collectionText += (collectionText === '' ? '' : ', ') + options[index].label;
              }
            }
          }
        }
      }
      return collectionText;
    },
    condition_type: function () {
      switch (this.filter.operation) {
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
        case 'all':
        case 'any':
        case 'include':
          return 'value';
        case 'past-after':
        case 'past-after-now':
        case 'past-before':
        case 'future-before':
        case 'future-before-now':
        case 'future-after':
          return 'unit';
      }

      return null;
    },
    conditionText: function () {
      if (this.condition_type === 'selection') {
        return this.operation;
      }

      let valueText = null;
      if (this.condition_type === 'value') {
        if (this.filter.hasOwnProperty('keyword')) {
          valueText = this.filter.keyword;
        } else if (this.filter.hasOwnProperty('datetime')) {
          valueText = this.filter.datetime;
        } else if (this.filter.hasOwnProperty('date')) {
          valueText = this.filter.date;
        } else if (this.filter.hasOwnProperty('values')) {
          valueText = this.collection;
        }
      } else if (this.condition_type === 'unit') {
        if (this.filter.hasOwnProperty('amount')) {
          valueText = this.filter.amount + ' ' + this.unit;
        }
      }

      if (valueText !== null) {
        if (this.condition_type === 'unit') {
          return this.operation.replace('...', ' ' + valueText + ' ');
        } else {
          return this.operation + '：' + valueText;
        }
      }

      return null;
    }
  }
}
</script>
