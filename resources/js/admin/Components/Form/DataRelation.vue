<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <label class="col-sm-2 col-form-label" :for="configs.key.replaceAll('.', '-')">
      {{ label }}<span class="text-danger ml-1" v-if="options.required">*</span>
    </label>
    <div class="col-sm-10 table-responsive">
      <table class="table table-sm table-bordered mb-1">
        <thead class="thead-default">
        <tr class="text-center">
          <th class="w-20">ID</th>
          <th class="text-left">Title</th>
          <th class="w-5">{{ array_get(trans, 'ui.grid.actions') }}</th>
        </tr>
        </thead>
        <tbody v-if="filled(value)">
        <tr v-for="itemId in value" :key="itemId">
          <td class="text-center">
            <a :href="itemUrl(itemId)" target="_blank">{{ itemId }}</a>
          </td>
          <td>
            {{ array_get(rowOptions, itemId) }}
          </td>
          <td class="text-center text-nowrap">
            <button class="btn btn-danger btn-sm" type="button" @click="removeItem(itemId)">
              <i class="icon-cross"></i>
            </button>
          </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
          <td colspan="2">
            <input
              :id="configs.key.replaceAll('.', '-')"
              type="text"
              class="form-control form-control-sm"
              autocomplete="false"
              :list="configs.key.replaceAll('.', '-') + '-list'"
              v-model="currentInput" />
            <datalist :id="configs.key.replaceAll('.', '-') + '-list'" v-if="availableItems.length > 0">
              <option v-for="item in availableItems" :value="item.value">{{ item.label }}</option>
            </datalist>
          </td>
          <td class="text-center text-nowrap">
            <button type="button" class="btn btn-primary btn-sm" @click="addItem()"><i class="icon-plus"></i></button>
          </td>
        </tr>
        </tfoot>
      </table>
    </div>
    <small v-if="filled(hint)" class="form-text text-muted ml-sm-auto col-sm-10">
      <span v-html="hint"></span>
    </small>
  </div>
</template>

<script>
export default {
  name: "DataRelation",
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        placeholder: null,
        required: false,
        hint: null,
        options: {}
      },
      liveOptions: {},
      searchTimer: null,
      currentInput: null,
      availableItems: []
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
    rowOptions: function () {
      let usedOptions = JSON.parse(JSON.stringify(this.options.options));
      for (let id in this.liveOptions) {
        if (usedOptions.hasOwnProperty(id)) {
          delete this.liveOptions[id];
        } else {
          usedOptions[id] = this.liveOptions[id];
        }
      }

      return this.blank(usedOptions) ? {} : usedOptions;
    }
  },
  watch: {
    currentInput: function (val) {
      clearTimeout(this.searchTimer);
      if (this.blank(val) || this.blank(this.array_get(this.options, 'reference'))) {
        this.availableItems = [];
      } else {
        this.searchTimer = setTimeout(() => {
          axios
            .post(this.array_get(this.options, 'reference'), {'keyword': val})
            .then((response) => {
              if (response.data.code === '0000') {
                this.availableItems = response.data.data;
              }
            });
        }, 300);
      }
    }
  },
  methods: {
    itemUrl: function (id) {
      let sampleUrl = this.array_get(this.options, 'reference_link');
      if (this.blank(sampleUrl)) {
        return '#';
      }

      return sampleUrl.replace('DumpId', id);
    },
    addItem: function () {
      if (this.filled(this.currentInput)) {
        let currentValue = this.blank(this.value) ? [] : JSON.parse(JSON.stringify(this.value));
        currentValue.push(this.currentInput);

        for (let i in this.availableItems) {
          if (this.availableItems[i].value === this.currentInput) {
            this.liveOptions[this.currentInput] = this.availableItems[i].label;
            break;
          }
        }

        this.$emit('input', currentValue);

        this.currentInput = null;
      }
    },
    removeItem: function (id) {
      let currentValue = this.blank(this.value) ? [] : JSON.parse(JSON.stringify(this.value));

      if (this.filled(currentValue) && currentValue.indexOf(id) !== -1) {
        currentValue.splice(currentValue.indexOf(id), 1);
        this.$emit('input', currentValue);

        if (this.liveOptions.hasOwnProperty(id)) {
          delete this.liveOptions[id];
        }
      }
    }
  }
}
</script>
