<script>
import {BOverlay} from 'bootstrap-vue';

export default {
  components: {
    BOverlay
  },
  props: {
    urls: Object,
    configs: Object
  },
  data() {
    return {
      formBusy: false,
      changedValues: {},
      liveValues: {},
      originalValues: {}
    }
  },
  mounted() {
    this.getData();
  },
  watch: {
    liveValues: {
      handler: function (afterVal) {
        let changedValues = {};
        for (let column in afterVal) {
          if (afterVal.hasOwnProperty(column) && this.originalValues.hasOwnProperty(column)) {
            if (this.blank(afterVal[column]) && this.blank(this.originalValues[column])) {
              continue;
            }

            if (Array.isArray(afterVal[column]) || typeof afterVal[column] === 'object') {
              if (JSON.stringify(afterVal[column]) !== JSON.stringify(this.originalValues[column])) {
                changedValues[column] = JSON.parse(JSON.stringify(afterVal[column]));
              }
            } else {
              if (afterVal[column] !== this.originalValues[column]) {
                changedValues[column] = afterVal[column];
              }
            }
          }
        }
        this.changedValues = changedValues;
      },
      deep: true
    }
  },
  methods: {
    getData: function () {
      if (this.filled(this.urls.api_data)) {
        this.changedValues = {};
        axios
          .get(this.urls.api_data)
          .then((response) => {
            this.originalValues = response.data.data;
            this.liveValues = JSON.parse(JSON.stringify(this.originalValues));
          });
      }
    },
    getOptions: function (column, optionSet) {
      if (this.blank(optionSet)) {
        return [];
      }
      return this.array_get(optionSet, column + '.options', []);
    },
    submitForm: function (trans) {
      if (this.filled(this.urls.update) && this.filled(this.changedValues)) {
        this.$store.commit('setBusy');

        axios
          .put(this.urls.update, this.changedValues)
          .then((response) => {
            if (response.data.code === '0000') {
              this.$swal({text: response.data.message, icon: 'success', timer: 2000})
                .then(() => {
                  let redirectTo = this.array_get(response.data, 'data.redirect_to');
                  if (this.blank(redirectTo)) {
                    this.getData();
                  } else {
                    location.href = redirectTo;
                  }
                });
            } else {
              this.$swal({text: response.data.message, icon: 'error'});
            }
          })
          .catch((error) => {
            for (let column in error.response.data.errors) {
              if (error.response.data.errors.hasOwnProperty(column)) {
                this.$swal({text: error.response.data.errors[column][0], icon: 'error'});
                break;
              }
            }
          })
          .finally(() => {
            this.$store.commit('clearBusy');
          });
      } else {
        this.$swal({text: this.array_get(trans, 'ui.message.no_changed'), icon: 'warning'});
      }
    }
  }
}
</script>
