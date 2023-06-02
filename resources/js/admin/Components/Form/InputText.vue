<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <label class="col-sm-2 col-form-label" :for="configs.key.replaceAll('.', '-')">
      {{ label }}<span class="text-danger ml-1" v-if="options.required">*</span>
    </label>
    <div :class="['col-sm-' + options.size]">
      <input v-if="blank(options.prefix) && blank(options.suffix)"
             :type="options.type" class="form-control"
             :id="configs.key.replaceAll('.', '-')"
             :placeholder="options.placeholder"
             :required="options.required"
             :value="value"
             v-on:input="$emit('input', $event.target.value)" />
      <div v-else class="input-group">
        <div class="input-group-prepend" v-if="filled(options.prefix)">
          <span class="input-group-text">{{ options.prefix }}</span>
        </div>
        <input :type="options.type" class="form-control"
               :id="configs.key.replaceAll('.', '-')"
               :placeholder="options.placeholder"
               :required="options.required"
               :value="value"
               v-on:input="$emit('input', $event.target.value)" />
        <div class="input-group-append" v-if="filled(options.suffix)">
          <span class="input-group-text">{{ options.suffix }}</span>
        </div>
      </div>
    </div>
    <small v-if="filled(hint)" class="form-text text-muted ml-sm-auto col-sm-10">
      <span v-html="hint"></span>
    </small>
  </div>
</template>

<script>
export default {
  name: "InputText",
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        size: 10,
        type: 'text',
        prefix: null,
        suffix: null,
        placeholder: null,
        required: false,
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
        return this.options.label;
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
