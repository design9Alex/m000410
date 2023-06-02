<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <label class="col-sm-2 col-form-label" :for="configs.key.replaceAll('.', '-')">
      {{ label }}<span class="text-danger ml-1" v-if="options.required">*</span>
    </label>
    <div :class="['col-sm-' + options.size]">
      <bootstrap-select v-on:input="$emit('input', $event)"
                        :id="configs.key.replaceAll('.', '-')"
                        class="form-control bs-select"
                        :title="options.title"
                        data-size="6"
                        data-style="btn-outline-secondary"
                        :data-live-search="options.liveSearch"
                        :data-none-results-text="array_get(trans, 'ui.filter.no_result_matched')"
                        :value="value"
                        :required="options.required"
                        :options="options.options" />
    </div>
    <small v-if="filled(hint)" class="form-text text-muted ml-sm-auto col-sm-10">
      <span v-html="hint"></span>
    </small>
  </div>
</template>

<script>
import BootstrapSelect from "../Module/BootstrapSelect";

export default {
  name: "Select",
  components: {
    BootstrapSelect
  },
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        title: false,
        liveSearch: false,
        size: 10,
        options: [],
        required: false,
        hint: null
      }
    }
  },
  mounted : function () {
  },
  computed: {
    options: function () {
      if (!this.configs.hasOwnProperty('options') || this.blank(this.configs.options)) {
        return this.defaultOptions;
      }
      let options = {...this.defaultOptions, ...this.configs.options}

      if (options.required === false) {
        let hasEmpty = false;
        for (let index in options.options) {
          if (!hasEmpty
            && options.options.hasOwnProperty(index)
            && this.blank(options.options[index].value)) {
            hasEmpty = true;
          }
        }
        if (!hasEmpty) {
          options.options.unshift({
            value: null,
            label: options.title !== false ? options.title : 'No Selected'
          });
          options.title = false;
        }
      }

      return options;
    },
    label: function () {
      if (this.filled(this.options.label)) {
        return this.options.label
      } else if (this.filled(this.trans)) {
        return this.array_get(this.trans, 'module.' + this.configs.key);
      }
      return null;
    },
    hint: function () {
      if (this.filled(this.options.hint)) {
        if (this.options.hint === false) {
          return null;
        }
        return this.options.hint;
      } else if (this.filled(this.trans)) {
        return this.array_get(this.trans, 'module.hints.' + this.configs.key);
      }
      return null;
    }
  }
}
</script>
