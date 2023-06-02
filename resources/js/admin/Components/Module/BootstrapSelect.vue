<template>
  <select ref="bsSelect">
    <template v-if="group">
      <optgroup v-for="groupSet in options" :label="groupSet.label" v-if="filled(groupSet.options)">
        <option v-for="option in groupSet.options"
                :value="option.value"
                :title="option.hasOwnProperty('name') ? option.name : false"
                :selected="selected(option.value)"
                :disabled="option.disabled === true"
                :key="Math.random()">{{ option.label }}</option>
      </optgroup>
    </template>
    <template v-else>
      <option v-for="option in options"
              :value="option.value"
              :title="option.hasOwnProperty('name') ? option.name : false"
              :selected="selected(option.value)"
              :disabled="option.disabled === true"
              :key="Math.random()">{{ option.label }}</option>
    </template>
  </select>
</template>

<script>
export default {
  name: "BootstrapSelect",
  props: {
    options: Array,
    value: [String, Number, Array],
    group: {
      type: Boolean,
      default: false
    }
  },
  mounted: function () {
    let _this = this;
    $(_this.$el).selectpicker('val', _this.currentValue);

    _this.$nextTick(() => {
      $(_this.$el).on('changed.bs.select', function () {
        if (JSON.stringify(_this.value) !== JSON.stringify($(this).val())) {
          _this.$emit('input', $(this).val());
        }
      });
    });
  },
  updated: function () {
    $(this.$el).selectpicker('val', this.currentValue);
    $(this.$el).selectpicker('refresh');
  },
  destroyed: function () {
    this.$nextTick(() => {
      $(this.$el).selectpicker('destroy');
    });
  },
  computed: {
    currentValue: function () {
      return this.filled(this.value) ? this.value : null;
    }
  },
  methods: {
    selected: function (value) {
      if (this.filled(this.$el) && this.$el.hasAttribute('multiple')) {
        if (this.blank(this.value) || !Array.isArray(this.value)) {
          return false;
        }
        return this.value.indexOf(value) !== -1;
      } else {
        return this.value === value;
      }
    }
  }
}
</script>
