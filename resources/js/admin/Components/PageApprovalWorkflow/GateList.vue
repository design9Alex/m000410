<template>
  <div class="form-group row">
    <div class="col-sm-2 col-form-label"></div>
    <div class="col-sm-10 table-responsive">
      <table v-for="(gate, gateIndex) in currentValue" class="table table-sm table-bordered mb-3">
        <thead>
        <tr class="bg-light">
          <th colspan="4">
            <i class="icon-arrow-long-down"></i> {{ array_get(trans, 'ui.label.gate_label') }} {{ gateIndex + 1 }}
          </th>
        </tr>
        </thead>
        <tbody v-if="filled(value)">
        <tr v-for="(condition, conditionIndex) in gate" :key="'cond-' + gateIndex + '-' + conditionIndex">
          <td class="text-center text-nowrap w-10">
            <button
              type="button"
              class="btn btn-outline-secondary btn-sm"
              :title="array_get(trans, 'ui.button.show')"
              @click="showCondition(gateIndex, conditionIndex)">
              <i class="icon-eye"></i>
            </button>
          </td>
          <td class="w-20">
            {{ condition.title }}
          </td>
          <td class="w-10 text-center">
            {{ array_get(trans, 'ui.gate.type_' + condition.type) }}
          </td>
          <td>
            Information ...
          </td>
        </tr>
        </tbody>
      </table>
    </div>
    <small v-if="filled(hint)" class="form-text text-muted ml-sm-auto col-sm-10">
      <span v-html="hint"></span>
    </small>
    <div class="modal fade bd-example-modal-lg show"
         style="display: block;" role="dialog"
         v-if="conditionBoxShow"
         @click="hideConditionBox($event)">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ array_get(trans, 'ui.label.gate_condition') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" @click="conditionBoxShow = false">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="col mb-3">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">{{ array_get(trans, 'ui.gate.title') }}</label>
                <div class="col-sm-10">
                  <div class="form-text">{{ currentCondition.title }}</div>
                </div>
              </div>
              <div class="form-group row" v-if="filled(array_get(options, 'department'))">
                <label class="col-sm-2 col-form-label">{{ array_get(trans, 'ui.gate.department') }}</label>
                <div class="col-sm-10">
                  <div class="form-text">{{ listSelection(options.department, currentCondition.department) }}</div>
                </div>
                <small v-if="filled(array_get(trans, 'ui.gate.hint.department'))"
                       class="form-text text-muted ml-sm-auto col-sm-10">
                  <span v-html="array_get(trans, 'ui.gate.hint.department')"></span>
                </small>
              </div>
              <div class="form-group row" v-if="filled(array_get(options, 'role'))">
                <label class="col-sm-2 col-form-label">{{ array_get(trans, 'ui.gate.role') }}</label>
                <div class="col-sm-10">
                  <div class="form-text">{{ listSelection(options.role, currentCondition.role) }}</div>
                </div>
                <small v-if="filled(array_get(trans, 'ui.gate.hint.role'))"
                       class="form-text text-muted ml-sm-auto col-sm-10">
                  <span v-html="array_get(trans, 'ui.gate.hint.role')"></span>
                </small>
              </div>
              <div class="form-group row" v-if="filled(array_get(options, 'user'))">
                <label class="col-sm-2 col-form-label">{{ array_get(trans, 'ui.gate.user') }}</label>
                <div class="col-sm-10">
                  <div class="form-text">{{ listSelection(options.user, currentCondition.user) }}</div>
                </div>
                <small v-if="filled(array_get(trans, 'ui.gate.hint.user'))"
                       class="form-text text-muted ml-sm-auto col-sm-10">
                  <span v-html="array_get(trans, 'ui.gate.hint.user')"></span>
                </small>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">{{ array_get(trans, 'ui.gate.type') }}</label>
                <div class="col-sm-10">
                  <div class="form-text">{{ array_get(trans, 'ui.gate.type_' + currentCondition.type) }}</div>
                </div>
                <small v-if="filled(array_get(trans, 'ui.gate.hint.type'))"
                       class="form-text text-muted ml-sm-auto col-sm-10">
                  <span v-html="array_get(trans, 'ui.gate.hint.type')"></span>
                </small>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">{{ array_get(trans, 'ui.gate.notify_pending') }}</label>
                <div class="col-sm-10">
                  <div class="form-text">
                    {{ array_get(trans, 'ui.gate.notify_pending_' + (currentCondition.notify_pending ? 1 : 0)) }}
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">{{ array_get(trans, 'ui.gate.notify_expire') }}</label>
                <div class="col-sm-10">
                  <div class="form-text">
                    {{ array_get(trans, 'ui.gate.notify_expire_' + (currentCondition.notify_pending ? 1 : 0)) }}
                  </div>
                </div>
              </div>

              <template v-if="filled(conditionColumns)" v-for="column in conditionColumns">
                <div v-if="str_is('minmax-input-text', column.component)" class="form-group row">
                  <label class="col-sm-2 col-form-label">{{ column.label }}</label>
                  <div class="col-sm-10">
                    <div class="form-text">{{ currentCondition[column.key] }}</div>
                  </div>
                </div>

                <div v-else-if="str_is('minmax-select', column.component)" class="form-group row">
                  <label class="col-sm-2 col-form-label">{{ column.label }}</label>
                  <div class="col-sm-10">
                    <div class="form-text">{{ listSelection(options[column.key], currentCondition[column.key]) }}</div>
                  </div>
                </div>

                <div v-else-if="str_is('minmax-multi-select', column.component)" class="form-group row">
                  <label class="col-sm-2 col-form-label">{{ column.label }}</label>
                  <div class="col-sm-10">
                    <div class="form-text">{{ listSelection(options[column.key], currentCondition[column.key]) }}</div>
                  </div>
                </div>

                <div v-else-if="str_is('minmax-radio', column.component)" class="form-group row">
                  <label class="col-sm-2 col-form-label">{{ column.label }}</label>
                  <div class="col-sm-10">
                    <div class="form-text">{{ listSelection(options[column.key], currentCondition[column.key]) }}</div>
                  </div>
                </div>
              </template>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-backdrop fade show" v-if="conditionBoxShow"></div>
  </div>
</template>

<script>
export default {
  name: "GateList",
  props: {
    trans: Object,
    configs: Object,
    value: Array
  },
  data() {
    return {
      conditionColumns: [],
      options: {},
      gateIndex: null,
      conditionIndex: null,
      currentCondition: {}
    }
  },
  created: function () {
    if (this.filled(this.configs.api_gate)) {
      axios.get(this.configs.api_gate)
        .then((response) => {
          this.conditionColumns = response.data.condition_columns;
          this.options = response.data.options;
        });
    }
  },
  computed: {
    currentValue: {
      get: function () {
        return this.blank(this.value) ? [] : this.value;
      },
      set: function (value) {
        this.$emit('input', this.blank(value) ? null : value);
      }
    },
    label: function () {
      if (this.filled(this.trans)) {
        return this.array_get(this.trans, 'module.' + this.configs.key);
      }
      return null;
    },
    hint: function () {
      if (this.filled(this.trans)) {
        return this.array_get(this.trans, 'module.hints.' + this.configs.key);
      }
      return null;
    },
    conditionBoxShow: {
      get: function () {
        return this.gateIndex !== null && this.conditionIndex !== null && this.filled(this.currentCondition);
      },
      set: function (value) {
        if (value === false) {
          this.gateIndex = null;
          this.conditionIndex = null;
          this.currentCondition = {};
        }
      }
    }
  },
  watch: {
    conditionBoxShow: function (value) {
      if (value) {
        document.body.classList.add("modal-open");
      } else {
        document.body.classList.remove("modal-open");
      }
    }
  },
  methods: {
    showCondition: function (gateIndex, conditionIndex) {
      this.gateIndex = gateIndex;
      this.conditionIndex = conditionIndex;
      this.currentCondition = JSON.parse(JSON.stringify(this.currentValue[this.gateIndex][this.conditionIndex]));
    },
    hideConditionBox: function ($event) {
      let classes = $event.target.classList;
      if (classes.contains('modal')) {
        this.conditionBoxShow = false;
      }
    },
    listSelection: function (options, value) {
      if (this.blank(options) || this.blank(value)) {
        return this.array_get(this.trans, 'ui.message.empty_data');
      }

      let values = Array.isArray(value) ? value : [value];

      let text = '';
      for (let i in values) {
        for (let j in options) {
          if (options[j].value === values[i]) {
            text += (this.blank(text) ? '' : ', ') + options[j].label;
            break;
          }
        }
      }

      return this.blank(text) ? this.array_get(this.trans, 'ui.message.empty_data') : text;
    }
  }
}
</script>
