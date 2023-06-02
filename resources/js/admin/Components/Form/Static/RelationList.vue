<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <label class="col-sm-2 col-form-label"
           :style="filled(configs.modified) ? {'text-decoration': 'underline dashed red 1px'} : {}">
      {{ label }}<span class="text-danger ml-1" v-if="options.required">*</span>
    </label>
    <div class="col-sm-10 table-responsive">
      <div v-if="blank(value)" class="form-text text-muted">
        {{ array_get(trans, 'ui.message.empty_list') }}
      </div>
      <table v-else class="table table-sm table-bordered mb-1">
        <thead class="thead-default">
        <tr>
          <th class="w-20 text-center">ID</th>
          <th>Title</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="itemId in value">
          <td class="text-center">
            <a :href="itemUrl(itemId)" target="_blank">{{ itemId }}</a>
          </td>
          <td>
            {{ array_get(rowOptions, itemId) }}
          </td>
        </tr>
        </tbody>
      </table>
    </div>
    <small v-if="filled(hint)" class="form-text text-muted ml-sm-auto col-sm-10">
      <span v-html="hint"></span>
    </small>
  </div>
</template>

<script>
export default {
  name: "RelationList",
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        placeholder: null,
        required: false,
        hint: null,
        options: {}
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
    rowOptions: function () {
      let usedOptions = JSON.parse(JSON.stringify(this.options.options));

      return this.blank(usedOptions) ? {} : usedOptions;
    }
  },
  methods: {
    itemUrl: function (id) {
      let sampleUrl = this.array_get(this.options, 'reference_link');
      if (this.blank(sampleUrl)) {
        return '#';
      }

      return sampleUrl.replace('DumpId', id);
    }
  }
}
</script>
