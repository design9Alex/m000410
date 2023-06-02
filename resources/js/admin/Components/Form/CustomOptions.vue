<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <label class="col-sm-2 col-form-label" :for="configs.key.replaceAll('.', '-')">
      {{ label }}<span class="text-danger ml-1" v-if="options.required">*</span>
    </label>
    <div :class="['col-sm-' + options.size]">
      <div class="form-row mb-2" v-for="(row, index) in optionList">
        <div class="col-4">
          <input class="form-control" type="text" placeholder="Key" v-model="row.key" />
        </div>
        <div class="col-7">
          <input class="form-control" type="text" placeholder="Value" v-model="row.value" />
        </div>
        <div class="col-auto">
          <button type="button" class="btn btn-danger"
                  @click="removeRow(index)"><i class="icon-cross"></i></button>
        </div>
      </div>
      <button type="button" class="btn btn-primary btn-sm"
              @click="addRow()"><i class="icon-plus"></i></button>
    </div>
    <small v-if="filled(hint)" class="form-text text-muted ml-sm-auto col-sm-10">
      <span v-html="hint"></span>
    </small>
  </div>
</template>

<script>
export default {
  name: "CustomOptions",
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        size: 10,
        placeholder: null,
        required: false,
        hint: null
      },
      optionList: []
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
  watch: {
    value: {
      handler: function (afterVal, beforeVal) {
        if (JSON.stringify(afterVal) === JSON.stringify(beforeVal)) {
          return;
        }

        let currentList = JSON.parse(JSON.stringify(this.optionList));
        if (this.filled(afterVal)) {
          if (currentList.length < afterVal.length) {
            for (let i = 0; i < afterVal.length - currentList.length; i++) {
              currentList.push({key: null, value: null});
            }
          }

          for (let index in afterVal) {
            if (afterVal.hasOwnProperty(index)) {
              currentList[index] = {key: afterVal[index].key, value: afterVal[index].value};
            }
          }
        }
        this.optionList = currentList;
      },
      immediate: true,
      deep: true
    },
    optionList: {
      handler: function (afterVal) {
        let value = [];
        for (let index in afterVal) {
          if (afterVal.hasOwnProperty(index) && this.filled(afterVal[index].key)) {
            value.push({key: afterVal[index].key, value: afterVal[index].value});
          }
        }
        this.triggerInput(value);
      },
      deep: true
    }
  },
  methods: {
    addRow: function () {
      let currentOptions = JSON.parse(JSON.stringify(this.optionList));
      currentOptions.push({key: null, value: null});
      this.optionList = currentOptions;
    },
    removeRow: function (index) {
      this.optionList.splice(index, 1);
    },
    triggerInput: function (value) {
      this.$emit('input', this.blank(value) ? null : value);
    }
  }
}
</script>
