<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <label class="col-sm-2 col-form-label">
      {{ label }}<span class="text-danger ml-1" v-if="options.required">*</span>
    </label>
    <div :class="['col-sm-' + options.size]">
      <div class="form-row">
        <div class="col-lg-auto mb-2 mb-lg-0 col-md-6">
          <input
            class="form-control"
            type="text"
            :placeholder="array_get(trans, 'ui.button.zipcode')"
            v-model="currentValue.zipcode" />
        </div>
        <div class="col-lg-auto mb-2 mb-lg-0 col-md-6">
          <bootstrap-select
            :id="configs.key.replaceAll('.', '-') + '-country'"
            class="form-control bs-select"
            :title="array_get(trans, 'ui.button.country')"
            :data-none-results-text="array_get(trans, 'ui.filter.no_result_matched')"
            data-size="6"
            data-style="btn-outline-secondary"
            :data-live-search="true"
            :options="world.countries"
            :value="currentValue.country"
            v-on:input="currentValue.country = $event" />
        </div>
        <div class="col-lg-auto mb-2 mb-lg-0 col-md-6">
          <bootstrap-select
            :id="configs.key.replaceAll('.', '-') + '-state'"
            class="form-control bs-select"
            :title="array_get(trans, 'ui.button.state')"
            :data-none-results-text="array_get(trans, 'ui.filter.no_result_matched')"
            data-size="6"
            data-style="btn-outline-secondary"
            :data-live-search="true"
            :options="world.states"
            :value="currentValue.state"
            v-on:input="currentValue.state = $event" />
        </div>
        <div class="col-lg-auto mb-2 mb-lg-0 col-md-6">
          <bootstrap-select
            :id="configs.key.replaceAll('.', '-') + '-county'"
            class="form-control bs-select"
            :title="array_get(trans, 'ui.button.county')"
            :data-none-results-text="array_get(trans, 'ui.filter.no_result_matched')"
            data-size="6"
            data-style="btn-outline-secondary"
            :data-live-search="true"
            :options="world.counties"
            :value="currentValue.county"
            v-on:input="currentValue.county = $event" />
        </div>
        <div class="col-lg-auto mb-2 mb-lg-0 col-md-6">
          <bootstrap-select
            :id="configs.key.replaceAll('.', '-') + '-city'"
            class="form-control bs-select"
            :title="array_get(trans, 'ui.button.city')"
            :data-none-results-text="array_get(trans, 'ui.filter.no_result_matched')"
            data-size="6"
            data-style="btn-outline-secondary"
            :data-live-search="true"
            :options="world.cities"
            :value="currentValue.city"
            v-on:input="currentValue.city = $event" />
        </div>
        <div class="col-lg">
          <input
            class="form-control"
            type="text"
            :placeholder="array_get(trans, 'ui.button.street')"
            v-model="currentValue.street" />
        </div>
      </div>

    </div>
    <small v-if="filled(hint)" class="form-text text-muted ml-sm-auto col-sm-10">
      <span v-html="hint"></span>
    </small>
  </div>
</template>

<script>
import BootstrapSelect from "../Module/BootstrapSelect";

export default {
  name: "Address",
  components: {
    BootstrapSelect
  },
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        size: 10,
        required: false,
        hint: null
      },
      world: {
        countries: [],
        states: [],
        counties: [],
        cities: []
      },
      currentValue: {
        country: null,
        state: null,
        county: null,
        city: null,
        zipcode: null,
        street: null
      }
    }
  },
  mounted : function () {
    axios.get(this.configs.api_options)
      .then((response) => {
        this.world.countries = response.data.code === '0000' ? response.data.data : [];
        if (this.filled(this.world.countries)) {
          this.world.countries.unshift({value: null, label: this.array_get(this.trans, 'ui.button.country')});
        }
      })
      .catch(() => this.world.countries = [])
      .finally(() => {
        for (let index in this.world.countries) {
          if (this.world.countries[index].value === this.currentValue.country) {
            return;
          }
        }
        this.currentValue.country = null;
      });
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
    }
  },
  watch: {
    value: {
      handler: function (value) {
        let address = {country: null, state: null, county: null, city: null, zipcode: null, street: null};
        if (this.blank(value)) {
          this.currentValue = address;
        } else {
          if (JSON.stringify(value) !== JSON.stringify(this.currentValue)) {
            this.currentValue = Object.assign(address, value);
          }
        }
      },
      deep: true
    },
    currentValue: {
      handler: function (value) {
        this.$emit('input', value);
      },
      deep: true
    },
    "currentValue.country": function (value) {
      if (this.blank(value)) {
        this.currentValue.state = null;
        this.world.states = [];
      } else if(this.filled(this.configs.api_options)) {
        axios.get(this.configs.api_options + '?parent=country&id=' + value)
          .then((response) => {
            this.world.states = response.data.code === '0000' ? response.data.data : [];
            if (this.filled(this.world.states)) {
              this.world.states.unshift({value: null, label: this.array_get(this.trans, 'ui.button.state')});
            }
          })
          .catch(() => {
            this.world.states = [];
          })
          .finally(() => {
            for (let index in this.world.states) {
              if (this.world.states[index].value === this.currentValue.state) {
                return;
              }
            }

            this.currentValue.state = null;

            if (this.world.states.length === 2) {
              for (let i in this.world.states) {
                if (this.filled(this.world.states[i].value)) {
                  this.currentValue.state = this.world.states[i].value
                }
              }
            }
          });
      }
    },
    "currentValue.state": function (value) {
      if (this.blank(value)) {
        this.currentValue.county = null;
        this.world.counties = [];
      } else if(this.filled(this.configs.api_options)) {
        axios.get(this.configs.api_options + '?parent=state&id=' + value)
          .then((response) => {
            this.world.counties = response.data.code === '0000' ? response.data.data : [];
            if (this.filled(this.world.counties)) {
              this.world.counties.unshift({value: null, label: this.array_get(this.trans, 'ui.button.county')});
            }
          })
          .catch(() => {
            this.world.counties = [];
          })
          .finally(() => {
            for (let index in this.world.counties) {
              if (this.world.counties[index].value === this.currentValue.county) {
                return;
              }
            }
            this.currentValue.county = null;

            if (this.world.counties.length === 2) {
              for (let i in this.world.counties) {
                if (this.filled(this.world.counties[i].value)) {
                  this.currentValue.county = this.world.counties[i].value
                }
              }
            }
          });
      }
    },
    "currentValue.county": function (value) {
      if (this.blank(value)) {
        this.currentValue.city = null;
        this.world.cities = [];
      } else if(this.filled(this.configs.api_options)) {
        axios.get(this.configs.api_options + '?parent=county&id=' + value)
          .then((response) => {
            this.world.cities = response.data.code === '0000' ? response.data.data : [];
            if (this.filled(this.world.cities)) {
              this.world.cities.unshift({value: null, label: this.array_get(this.trans, 'ui.button.city')});
            }
          })
          .catch(() => {
            this.world.cities = [];
          })
          .finally(() => {
            for (let index in this.world.cities) {
              if (this.world.cities[index].value === this.currentValue.city) {
                return;
              }
            }
            this.currentValue.city = null;

            if (this.world.cities.length === 2) {
              for (let i in this.world.cities) {
                if (this.filled(this.world.cities[i].value)) {
                  this.currentValue.city = this.world.cities[i].value
                }
              }
            }
          });
      }
    },
    "currentValue.city": function (value) {
      axios.get(this.configs.api_zipcode + '?id=' + value)
        .then((response) => {
          if (response.data.code === '0000' && this.filled(response.data.data)) {
            this.currentValue.zipcode = response.data.data;
          }
        });
    }
  }
}
</script>
