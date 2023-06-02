<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <label class="col-sm-2 col-form-label" :for="configs.key.replaceAll('.', '-')">
      {{ label }}<span class="text-danger ml-1" v-if="options.required">*</span>
    </label>
    <div :class="['col-sm-' + options.size]">
      <textarea type="text" class="form-control"
                :id="configs.key.replaceAll('.', '-')"
                :rows="options.rows"
                :placeholder="options.placeholder"
                :required="options.required"
                :value="value"
                v-on:input="$emit('input', $event.target.value)"></textarea>
      <span
        v-if="filled(options.limit) && options.limit > 0"
        class="form-control border-0 pr-4 bg-transparent text-right"
        :class="isExceed() ? ['text-danger', 'font-weight-bold'] : ['text-muted']"
        style="margin-top:-2.25rem;pointer-events:none">{{ text_counter }} / {{ options.limit }}</span>
    </div>
    <small v-if="filled(hint)" class="form-text text-muted ml-sm-auto col-sm-10">
      <span v-html="hint"></span>
    </small>
  </div>
</template>

<script>
export default {
  name: "Textarea",
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        size: 10,
        rows: 4,
        placeholder: null,
        required: false,
        limit: 0,
        hint: null
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
    },
    text_counter: function () {
      if (this.filled(this.value)) {
        return this.value.length;
      }
      return 0;
    }
  },
  methods: {
    isExceed: function () {
      return this.text_counter > this.options.limit;
    }
  }
}
</script>
