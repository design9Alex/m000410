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
      liveValues: {},
      defaultValues: {}
    }
  },
  mounted() {
    this.getData();
  },
  methods: {
    getData: function () {
      if (this.filled(this.urls.api_data)) {
        axios
          .get(this.urls.api_data)
          .then((response) => {
            if (this.filled(response.data.data)) {
              this.defaultValues = response.data.data;
            }
            this.liveValues = JSON.parse(JSON.stringify(this.defaultValues));
          });
      }
    },
    getOptions: function (column, optionSet) {
      return this.array_get(optionSet, column + '.options', []);
    },
    submitForm: function (trans) {
      if (this.filled(this.urls.store) && this.filled(this.liveValues)) {
        this.$store.commit('setBusy');

        axios
          .post(this.urls.store, this.liveValues)
          .then((response) => {
            if (response.data.code === '0000') {
              this.$swal({text: response.data.message, icon: 'success', timer: 2000})
                .then(() => {
                  if (this.filled(response.data.data.redirect_to)) {
                    location.href = response.data.data.redirect_to;
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
        this.$swal({text: this.array_get(trans, 'ui.message.no_attribute'), icon: 'warning'});
      }
    }
  }
}
</script>
