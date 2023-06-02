<template>
  <div class="form-group row">
    <div class="col-sm-2 col-form-label">
      <button class="btn btn-sm btn-main mb-2" type="button" @click="addGate()">
        <i class="icon-plus2"></i> {{ array_get(trans, 'ui.button.add_gate') }}
      </button><br />
      <button class="btn btn-sm btn-secondary mb-2" type="button" @click="currentValue = []">
        <i class="icon-trashcan"></i> {{ array_get(trans, 'ui.button.flush') }}
      </button>
    </div>
    <div class="col-sm-10 table-responsive">
      <table v-for="(gate, gateIndex) in currentValue" class="table table-sm table-bordered mb-3">
        <thead>
        <tr class="bg-light">
          <th colspan="4">
            <i class="icon-arrow-long-down"></i> {{ array_get(trans, 'ui.label.gate_label') }} {{ gateIndex + 1 }}
            <div class="float-right">
              <button class="btn btn-secondary btn-sm" type="button" @click="addCondition(gateIndex)">
                <i class="icon-plus"></i> {{ array_get(trans, 'ui.button.add_condition') }}
              </button>
              <button class="btn btn-secondary btn-sm" type="button" @click="removeGate(gateIndex)">
                <i class="icon-cross"></i> {{ array_get(trans, 'ui.button.remove_gate') }}
              </button>
            </div>
          </th>
        </tr>
        </thead>
        <tbody v-if="filled(value)">
        <tr v-for="(condition, conditionIndex) in gate" :key="'cond-' + gateIndex + '-' + conditionIndex">
          <td class="text-center text-nowrap w-10">
            <button
              type="button"
              class="btn btn-outline-secondary btn-sm"
              :title="array_get(trans, 'ui.button.edit')"
              @click="editCondition(gateIndex, conditionIndex)">
              <i class="icon-pencil"></i>
            </button>
            <button
              v-if="gate.length > 1"
              type="button"
              class="btn btn-outline-secondary btn-sm"
              :title="array_get(trans, 'ui.button.destroy')"
              @click="removeCondition(gateIndex, conditionIndex)">
              <i class="icon-cross"></i>
            </button>
          </td>
          <td class="w-20">
            {{ condition.title }}
          </td>
          <td class="w-10 text-center">
            {{ array_get(trans, 'ui.gate.type_' + condition.type) }}
          </td>
          <td>
            {{ listAssessors(condition) }}
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
                  <input type="text" class="form-control" v-model="currentCondition.title" />
                </div>
              </div>
              <div class="form-group row" v-if="filled(array_get(options, 'department'))">
                <label class="col-sm-2 col-form-label">{{ array_get(trans, 'ui.gate.department') }}</label>
                <div class="col-sm-10">
                  <bootstrap-select
                    id="gate-department"
                    class="form-control bs-select"
                    :title="array_get(trans, 'ui.gate.department')"
                    data-size="6"
                    data-style="btn-outline-secondary"
                    :options="options.department"
                    :value="currentCondition.department"
                    v-on:input="currentCondition.department = $event"
                    multiple />
                </div>
                <small v-if="filled(array_get(trans, 'ui.gate.hint.department'))"
                       class="form-text text-muted ml-sm-auto col-sm-10">
                  <span v-html="array_get(trans, 'ui.gate.hint.department')"></span>
                </small>
              </div>
              <div class="form-group row" v-if="filled(array_get(options, 'role'))">
                <label class="col-sm-2 col-form-label">{{ array_get(trans, 'ui.gate.role') }}</label>
                <div class="col-sm-10">
                  <bootstrap-select
                    id="gate-role"
                    class="form-control bs-select"
                    :title="array_get(trans, 'ui.gate.role')"
                    data-size="6"
                    data-style="btn-outline-secondary"
                    :data-live-search="filled(options.role) && options.role.length > 6"
                    :data-none-results-text="array_get(trans, 'ui.filter.no_result_matched')"
                    :options="options.role"
                    :value="currentCondition.role"
                    v-on:input="currentCondition.role = $event"
                    multiple />
                </div>
                <small v-if="filled(array_get(trans, 'ui.gate.hint.role'))"
                       class="form-text text-muted ml-sm-auto col-sm-10">
                  <span v-html="array_get(trans, 'ui.gate.hint.role')"></span>
                </small>
              </div>
              <div class="form-group row" v-if="filled(array_get(options, 'user'))">
                <label class="col-sm-2 col-form-label">{{ array_get(trans, 'ui.gate.user') }}</label>
                <div class="col-sm-10">
                  <bootstrap-select
                    id="gate-user"
                    class="form-control bs-select"
                    :title="array_get(trans, 'ui.gate.user')"
                    data-size="6"
                    data-style="btn-outline-secondary"
                    :data-live-search="filled(options.user) && options.user.length > 6"
                    :data-none-results-text="array_get(trans, 'ui.filter.no_result_matched')"
                    :options="options.user"
                    :value="currentCondition.user"
                    v-on:input="currentCondition.user = $event"
                    multiple />
                </div>
                <small v-if="filled(array_get(trans, 'ui.gate.hint.user'))"
                       class="form-text text-muted ml-sm-auto col-sm-10">
                  <span v-html="array_get(trans, 'ui.gate.hint.user')"></span>
                </small>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">{{ array_get(trans, 'ui.gate.type') }}</label>
                <div class="col-sm-10">
                  <div class="custom-control custom-radio custom-control-inline mt-2">
                    <input id="gate-type-single" class="custom-control-input" type="radio"
                           value="single" v-model="currentCondition.type" />
                    <label for="gate-type-single" class="custom-control-label">
                      {{ array_get(trans, 'ui.gate.type_single') }}</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline mt-2">
                    <input id="gate-type-all" class="custom-control-input" type="radio"
                           value="all" v-model="currentCondition.type" />
                    <label for="gate-type-all" class="custom-control-label">
                      {{ array_get(trans, 'ui.gate.type_all') }}</label>
                  </div>
                </div>
                <small v-if="filled(array_get(trans, 'ui.gate.hint.type'))"
                       class="form-text text-muted ml-sm-auto col-sm-10">
                  <span v-html="array_get(trans, 'ui.gate.hint.type')"></span>
                </small>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">{{ array_get(trans, 'ui.gate.notify_pending') }}</label>
                <div class="col-sm-10">
                  <div class="custom-control custom-radio custom-control-inline mt-2">
                    <input id="gate-notify-pending-1" class="custom-control-input" type="radio"
                           :value="true" v-model="currentCondition.notify_pending" />
                    <label for="gate-notify-pending-1" class="custom-control-label">
                      {{ array_get(trans, 'ui.gate.notify_pending_1') }}</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline mt-2">
                    <input id="gate-notify-pending-0" class="custom-control-input" type="radio"
                           :value="false" v-model="currentCondition.notify_pending" />
                    <label for="gate-notify-pending-0" class="custom-control-label">
                      {{ array_get(trans, 'ui.gate.notify_pending_0') }}</label>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">{{ array_get(trans, 'ui.gate.notify_expire') }}</label>
                <div class="col-sm-10">
                  <div class="custom-control custom-radio custom-control-inline mt-2">
                    <input id="gate-notify-expire-1" class="custom-control-input" type="radio"
                           :value="true" v-model="currentCondition.notify_expire" />
                    <label for="gate-notify-expire-1" class="custom-control-label">
                      {{ array_get(trans, 'ui.gate.notify_expire_1') }}</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline mt-2">
                    <input id="gate-notify-expire-0" class="custom-control-input" type="radio"
                           :value="false" v-model="currentCondition.notify_expire" />
                    <label for="gate-notify-expire-0" class="custom-control-label">
                      {{ array_get(trans, 'ui.gate.notify_expire_0') }}</label>
                  </div>
                </div>
              </div>

              <template v-if="filled(conditionColumns)" v-for="column in conditionColumns">
                <div v-if="str_is('minmax-input-text', column.component)" class="form-group row">
                  <label class="col-sm-2 col-form-label">{{ column.label }}</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" v-model="currentCondition[column.key]" />
                  </div>
                </div>

                <div v-else-if="str_is('minmax-select', column.component)" class="form-group row">
                  <label class="col-sm-2 col-form-label">{{ column.label }}</label>
                  <div class="col-sm-10">
                    <bootstrap-select
                      :id="'gate-' + column.key"
                      class="form-control bs-select"
                      :title="array_get(trans, 'ui.gate.user')"
                      data-size="6"
                      data-style="btn-outline-secondary"
                      :data-live-search="filled(options[column.key]) && options[column.key].length > 6"
                      :data-none-results-text="array_get(trans, 'ui.filter.no_result_matched')"
                      :options="options[column.key]"
                      :value="currentCondition[column.key]"
                      v-on:input="currentCondition[column.key] = $event" />
                  </div>
                </div>

                <div v-else-if="str_is('minmax-multi-select', column.component)" class="form-group row">
                  <label class="col-sm-2 col-form-label">{{ column.label }}</label>
                  <div class="col-sm-10">
                    <bootstrap-select
                      :id="'gate-' + column.key"
                      class="form-control bs-select"
                      :title="array_get(trans, 'ui.gate.user')"
                      data-size="6"
                      data-style="btn-outline-secondary"
                      :data-live-search="filled(options[column.key]) && options[column.key].length > 6"
                      :data-none-results-text="array_get(trans, 'ui.filter.no_result_matched')"
                      :options="options[column.key]"
                      :value="currentCondition[column.key]"
                      v-on:input="currentCondition[column.key] = $event"
                      multiple />
                  </div>
                </div>

                <div v-else-if="str_is('minmax-radio', column.component)" class="form-group row">
                  <label class="col-sm-2 col-form-label">{{ column.label }}</label>
                  <div class="col-sm-10">
                    <div
                      v-for="(option, optionIndex) in options[column.key]"
                      class="custom-control custom-radio custom-control-inline mt-2">
                      <input :id="'gate-' + column.key + '-' + optionIndex" class="custom-control-input" type="radio"
                             :value="option.value" v-model="currentCondition[column.key]" />
                      <label :for="'gate-' + column.key + '-' + optionIndex" class="custom-control-label">
                        {{ option.label }}</label>
                    </div>
                  </div>
                </div>
              </template>
            </div>

            <div class="text-center my-4 form-btn-group">
              <button
                class="btn btn-main"
                type="button"
                :disabled="!canAdmit()"
                @click="updateCondition()">
                {{ array_get(trans, 'ui.button.admit') }}</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-backdrop fade show" v-if="conditionBoxShow"></div>
  </div>
</template>

<script>
import BootstrapSelect from "../Module/BootstrapSelect";

export default {
  name: "Gates",
  components: {
    BootstrapSelect
  },
  props: {
    trans: Object,
    configs: Object,
    value: Array
  },
  data() {
    return {
      sampleCondition: {},
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
          this.sampleCondition = response.data.sample;
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
          if (this.gateIndex !== null && this.conditionIndex !== null && !this.canAdmit(false)) {
            if (this.currentValue[this.gateIndex].length === 1) {
              this.removeGate(this.gateIndex);
            } else {
              this.removeCondition(this.gateIndex, this.conditionIndex);
            }
          }

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
    addGate: function () {
      let newValue = JSON.parse(JSON.stringify(this.currentValue));
      newValue.push([JSON.parse(JSON.stringify(this.sampleCondition).replace('{num}', '1'))]);
      this.currentValue = newValue;

      this.$nextTick(() => this.editCondition(this.currentValue.length - 1, 0));
    },
    removeGate: function (gateIndex) {
      let newValue = JSON.parse(JSON.stringify(this.currentValue));
      if (newValue.hasOwnProperty(gateIndex)) {
        newValue.splice(gateIndex, 1);
        this.currentValue = newValue;
      }
    },
    addCondition: function (gateIndex) {
      let newValue = JSON.parse(JSON.stringify(this.currentValue));
      if (newValue.hasOwnProperty(gateIndex)) {
        newValue[gateIndex].push(
          JSON.parse(JSON.stringify(this.sampleCondition).replace('{num}', newValue[gateIndex].length + 1))
        );
        this.currentValue = newValue;

        this.$nextTick(() => this.editCondition(gateIndex, newValue[gateIndex].length - 1));
      }
    },
    editCondition: function (gateIndex, conditionIndex) {
      this.gateIndex = gateIndex;
      this.conditionIndex = conditionIndex;
      this.currentCondition = JSON.parse(JSON.stringify(this.currentValue[this.gateIndex][this.conditionIndex]));
    },
    removeCondition: function (gateIndex, conditionIndex) {
      let newValue = JSON.parse(JSON.stringify(this.currentValue));
      if (newValue.hasOwnProperty(gateIndex)) {
        if (newValue[gateIndex].hasOwnProperty(conditionIndex)) {
          newValue[gateIndex].splice(conditionIndex, 1);
        }
      }
      this.currentValue = newValue;
    },
    updateCondition: function () {
      let newValue = JSON.parse(JSON.stringify(this.currentValue));
      newValue[this.gateIndex][this.conditionIndex] = JSON.parse(JSON.stringify(this.currentCondition));
      this.currentValue = newValue;

      this.$nextTick(() => {this.conditionBoxShow = false});
    },
    canAdmit: function (editing = true, gateIndex = null, conditionIndex = null) {
      gateIndex = gateIndex === null ? this.gateIndex : gateIndex;
      conditionIndex = conditionIndex === null ? this.conditionIndex : conditionIndex;

      let currentCondition = editing
        ? this.currentCondition
        : this.array_get(this.currentValue, gateIndex + '.' + conditionIndex);

      return this.filled(this.array_get(currentCondition, 'title'))
        && (this.filled(this.array_get(currentCondition, 'department'))
          || this.filled(this.array_get(currentCondition, 'role'))
          || this.filled(this.array_get(currentCondition, 'user'))
        );
    },
    hideConditionBox: function ($event) {
      let classes = $event.target.classList;
      if (classes.contains('modal')) {
        this.conditionBoxShow = false;
      }
    },
    listAssessors: function (condition) {
      if (this.blank(condition.department) && this.blank(condition.role) && this.blank(condition.user)) {
        return '-';
      }

      let text = '';

      if (this.filled(condition.department) && this.filled(this.array_get(this.options, 'department'))) {
        for (let i in condition.department) {
          for (let j in this.options.department) {
            if (this.options.department[j].value === condition.department[i]) {
              text += (this.blank(text) ? '' : ', ') + this.options.department[j].label;
            }
          }
        }
      }

      if (this.filled(condition.role) && this.filled(this.array_get(this.options, 'role'))) {
        for (let i in condition.role) {
          for (let j in this.options.role) {
            if (this.options.role[j].value === condition.role[i]) {
              text += (this.blank(text) ? '' : ', ') + this.options.role[j].label;
            }
          }
        }
      }

      if (this.filled(condition.user) && this.filled(this.array_get(this.options, 'user'))) {
        for (let i in condition.user) {
          for (let j in this.options.user) {
            if (this.options.user[j].value === condition.user[i]) {
              text += (this.blank(text) ? '' : ', ') + this.options.user[j].label;
            }
          }
        }
      }

      return this.blank(text) ? '-' : text;
    }
  }
}
</script>
