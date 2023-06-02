<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <label class="col-sm-2 col-form-label"
           :style="filled(configs.modified) ? {'text-decoration': 'underline dashed red 1px'} : {}">
      {{ label }}<span class="text-danger ml-1" v-if="options.required">*</span>
    </label>
    <div :class="['col-sm-' + options.size]">
      <div v-if="blank(address)" class="form-text text-muted">
        {{ array_get(trans, 'ui.message.empty_data') }}
      </div>
      <div class="form-text" v-html="address"></div>
    </div>
    <small v-if="filled(hint)" class="form-text text-muted ml-sm-auto col-sm-10">
      <span v-html="hint"></span>
    </small>
  </div>
</template>

<script>
export default {
  name: "FullAddress",
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
    },
    address: function () {
      if (this.blank(this.currentValue)) {
        return null;
      }

      let format = null;

      let country = this.array_get(this.currentValue, 'country');
      let countryLabel = '';
      if (this.filled(country) && this.filled(this.world.countries)) {
        for (let i in this.world.countries) {
          if (this.world.countries[i].value === country) {
            countryLabel = this.world.countries[i].label;
            format = this.world.countries[i].format;
          }
        }
      }

      let state = this.array_get(this.currentValue, 'state');
      let stateLabel = '';
      if (this.filled(country) && this.filled(state) && this.filled(this.world.states)) {
        for (let i in this.world.states) {
          if (this.world.states[i].value === state) {
            stateLabel = this.world.states[i].label;
          }
        }
      }

      let county = this.array_get(this.currentValue, 'county');
      let countyLabel = '';
      if (this.filled(state) && this.filled(county) && this.filled(this.world.counties)) {
        for (let i in this.world.counties) {
          if (this.world.counties[i].value === county) {
            countyLabel = this.world.counties[i].label;
          }
        }
      }

      let city = this.array_get(this.currentValue, 'city');
      let cityLabel = '';
      if (this.filled(county) && this.filled(city) && this.filled(this.world.cities)) {
        for (let i in this.world.cities) {
          if (this.world.cities[i].value === city) {
            cityLabel = this.world.cities[i].label;
          }
        }
      }

      let zipcode = this.array_get(this.currentValue, 'zipcode');
      if (this.blank(zipcode)) {
        zipcode = '';
      }

      let street = this.array_get(this.currentValue, 'street');
      if (this.blank(street)) {
        street = '';
      }

      if (format === null) {
        return zipcode + countryLabel + stateLabel + countyLabel + cityLabel + street;
      } else {
        return format
          .replace('{zip}', zipcode)
          .replace('{country}', countryLabel)
          .replace('{state}', stateLabel)
          .replace('{county}', countyLabel)
          .replace('{city}', cityLabel)
          .replace('{street}', street)
          .replace("\n", '<br />');
      }
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
    "currentValue.country": function (value) {
      if (this.blank(value)) {
        this.currentValue.state = null;
        this.world.states = [];
      } else if(this.filled(this.configs.api_options)) {
        axios.get(this.configs.api_options + '?parent=country&id=' + value)
          .then((response) => {
            this.world.states = response.data.code === '0000' ? response.data.data : [];
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
          });
      }
    }
  }
}
</script>
