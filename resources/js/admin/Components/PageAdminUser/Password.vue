<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <label class="col-sm-2 col-form-label" :for="configs.key.replaceAll('.', '-')">
      {{ label }}<span class="text-danger ml-1" v-if="options.required">*</span>
    </label>
    <div :class="['col-sm-' + options.size]">
      <input :type="passwordShowing ? 'text' : 'password'" class="form-control"
             :id="configs.key.replaceAll('.', '-')"
             :placeholder="options.placeholder"
             :required="options.required"
             :value="value"
             autocomplete="off"
             ref="passwordInput"
             v-on:input="$emit('input', $event.target.value)" />
    </div>
    <div :class="['col-sm-' + (10 - options.size)]">
      <button class="btn btn-secondary" type="button" @click="generatePassword">
        <i class="icon-loop2 mr-2"></i>{{ array_get(trans, 'ui.button.password_generator') }}
      </button>
      <button class="btn btn-secondary" type="button" @click="showPassword">
        <i :class="{'icon-lock3': !passwordShowing, 'icon-lock-opened': passwordShowing}"></i>
      </button>
    </div>
    <small v-if="filled(hint)" class="form-text text-muted ml-sm-auto col-sm-10">
      <span v-html="hint"></span>
    </small>
  </div>
</template>

<script>
export default {
  name: "Password",
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        size: 3,
        placeholder: null,
        required: false,
        hint: null
      },
      passwordShowing: false,
      showerTimer: null
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
  },
  methods: {
    generatePassword: function () {
      let words = Math.random().toString(36).slice(-8);
      this.passwordShowing = false;
      this.$emit('input', words);
      this.showPassword();
      this.$nextTick(() => {
        navigator.clipboard.writeText(words);
      });
    },
    showPassword: function () {
      clearTimeout(this.showerTimer);
      if (this.passwordShowing) {
        this.passwordShowing = false;
      } else {
        this.passwordShowing = true;
        this.showerTimer = setTimeout(() => this.passwordShowing = false, 5000);
      }
    }
  }
}
</script>
