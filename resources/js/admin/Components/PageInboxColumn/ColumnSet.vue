<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <label class="col-sm-2 col-form-label" :for="configs.key.replaceAll('.', '-')">
      {{ label }}<span class="text-danger ml-1" v-if="options.required">*</span>
    </label>
    <div :class="['col-sm-' + options.size]">
      <table class="table table-sm table-bordered mb-1">
        <thead>
        <tr>
          <th>欄位名稱</th>
          <th>欄位組件</th>
          <th class="text-center w-15">組件設定</th>
          <th class="text-center w-10">動作</th>
        </tr>
        </thead>
        <tbody v-if="blank(currentValue)">
        <tr>
          <td colspan="4">沒有欄位設定</td>
        </tr>
        </tbody>
        <tbody v-else @dragover="moving" @drop="moveReceived">
        <tr v-for="(setting, index) in currentValue" draggable="true" @dragstart="moveStart($event, index)">
          <td>{{ setting.column }}</td>
          <td>{{ setting.component }}</td>
          <td class="text-center text-nowrap">
            <button type="button" class="btn btn-secondary btn-sm" @click="editDetail(index)">
              <i class="icon-cog"></i> 參數設定
            </button>
          </td>
          <td class="text-center text-nowrap">
            <button type="button" class="btn btn-danger btn-sm" @click="removeColumn(index)">
              <i class="icon-cross"></i>
            </button>
          </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
          <td>
            <input type="text" class="form-control form-control-sm"
                   v-model="columnInput.column" />
          </td>
          <td>
            <input type="text" class="form-control form-control-sm"
                   v-model="columnInput.component" />
          </td>
          <td class="text-center">-</td>
          <td class="text-center">
            <button type="button" class="btn btn-primary btn-sm" @click="pushColumn()">
              <i class="icon-plus"></i>
            </button>
          </td>
        </tr>
        </tfoot>
      </table>
    </div>
    <small v-if="filled(hint)" class="form-text text-muted ml-sm-auto col-sm-10">
      <span v-html="hint"></span>
    </small>

    <div class="modal fade bd-example-modal-lg show"
         style="display: block;" role="dialog" aria-modal="true"
         v-if="currentDetail !== null"
         @click="hideDetail($event)">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ currentDetail.column }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" @click="currentDetail = null">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-sm table-bordered mb-1">
              <thead>
              <tr>
                <th>鍵名</th>
                <th>數值</th>
                <th class="text-center w-10">動作</th>
              </tr>
              </thead>
              <tbody v-if="blank(currentOptions)">
              <tr>
                <td class="text-center text-muted" colspan="3">沒有參數設定</td>
              </tr>
              </tbody>
              <tbody v-else>
              <tr v-for="(option, index) in currentOptions">
                <td>{{ option.key }}</td>
                <td>{{ option.value }}</td>
                <td class="text-center">
                  <button type="button" class="btn btn-danger btn-sm" @click="removeOption(index)">
                    <i class="icon-cross"></i>
                  </button>
                </td>
              </tr>
              </tbody>
              <tfoot>
              <tr>
                <td>
                  <input type="text" class="form-control form-control-sm" placeholder="Key"
                         v-model="optionInput.key" />
                </td>
                <td>
                  <input type="text" class="form-control form-control-sm" placeholder="Value"
                         v-model="optionInput.value" />
                </td>
                <td class="text-center">
                  <button type="button" class="btn btn-primary btn-sm" @click="pushOption()">
                    <i class="icon-plus"></i>
                  </button>
                </td>
              </tr>
              </tfoot>
            </table>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button"
                    @click="currentDetail = null">{{ array_get(trans, 'ui.button.cancel') }}</button>
            <button class="btn btn-primary" type="button"
                    @click="updateDetail(currentDetail.index)">{{ array_get(trans, 'ui.button.submit') }}</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-backdrop fade show" v-if="currentDetail !== null"></div>
  </div>
</template>

<script>
export default {
  name: "ColumnSet",
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        size: 10,
        required: false,
        hint: null
      },
      defaultValue: [],
      currentDetail: null,
      currentOptions: [],
      currentPreview: null,
      columnInput: {
        column: null,
        component: null
      },
      optionInput: {
        key: null,
        value: null
      }
    }
  },
  watch: {
    currentDetail: function (value) {
      if (value === null) {
        document.body.classList.remove("modal-open");
      } else {
        document.body.classList.add("modal-open");
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
    },
    currentValue: {
      get: function () {
        return this.blank(this.value) ? [] : this.value;
      },
      set: function (value) {
        this.$emit('input', JSON.parse(JSON.stringify(value)));
      }
    }
  },
  methods: {
    hideDetail: function ($event) {
      let classes = $event.target.classList;
      if (classes.contains('modal')) {
        this.currentDetail = null;
      }
    },
    moveStart: function ($event, index) {
      $event.dataTransfer.setData("text/plain", index);
      $event.dropEffect = "move";
    },
    moving: function ($event) {
      $event.preventDefault();
      $event.dataTransfer.dropEffect = "move";
    },
    moveReceived: function ($event) {
      $event.preventDefault();
      let index = parseInt($event.dataTransfer.getData("text"));
      let target = $event.target.closest('tbody > tr');
      let targetIndex = target === null
        ? this.currentValue.length - 1
        : Array.from(target.parentNode.children).indexOf(target);
      this.sortColumn(index, targetIndex);
    },
    sortColumn: function (sourceIndex, targetIndex) {
      if (sourceIndex === targetIndex) {
        return;
      }

      let sorted = [];
      for (let index in this.currentValue) {
        if (!this.currentValue.hasOwnProperty(index)) continue;

        if (parseInt(index) === sourceIndex) continue;

        if (sourceIndex < targetIndex) {
          sorted.push(this.currentValue[index]);
        }

        if (parseInt(index) === targetIndex) {
          sorted.push(this.currentValue[sourceIndex]);
        }

        if (sourceIndex > targetIndex) {
          sorted.push(this.currentValue[index]);
        }
      }

      this.currentValue = sorted;
    },
    pushColumn: function () {
      let currentValue = this.currentValue;
      currentValue.push({"column": this.columnInput.column, "component": this.columnInput.component});
      this.currentValue = currentValue;
      this.columnInput.column = null;
      this.columnInput.component = null;
    },
    removeColumn: function (index) {
      let value = this.currentValue;
      value.splice(index, 1);
      this.currentValue = value;
    },
    pushOption: function () {
      let currentOptions = this.currentOptions;
      let duplicated = false;
      for (let i in currentOptions) {
        if (currentOptions.hasOwnProperty(i) && currentOptions[i].key === this.optionInput.key) {
          currentOptions[i].value = this.optionInput.value;
          duplicated = true;
        }
      }
      if (!duplicated) {
        currentOptions.push({"key": this.optionInput.key, "value": this.optionInput.value});
      }

      this.currentOptions = currentOptions;
      this.optionInput.key = null;
      this.optionInput.value = null;
    },
    removeOption: function (index) {
      let value = this.currentOptions;
      value.splice(index, 1);
      this.currentOptions = value;
    },
    editDetail: function (index) {
      this.currentDetail = this.currentValue[index];
      this.currentDetail.index = index;

      let options = [];
      for (let attribute in this.currentDetail) {
        if (attribute === 'column' || attribute === 'component' || attribute === 'index') {
          continue;
        }
        options.push({"key": attribute, "value": this.currentDetail[attribute]});
      }
      this.currentOptions = options;
    },
    updateDetail: function (index) {
      let value = this.currentValue;
      let rowValue = {
        "column": this.currentDetail.column,
        "component": this.currentDetail.component
      };
      for (let key in this.currentOptions) {
        if (this.currentOptions.hasOwnProperty(key)) {
          rowValue[this.currentOptions[key].key] = this.currentOptions[key].value;
        }
      }
      value[index] = rowValue;

      this.currentValue = value;
      this.currentDetail = null;
      this.currentOptions = [];
      this.optionInput.key = null;
      this.optionInput.value = null;
    }
  }
}
</script>
