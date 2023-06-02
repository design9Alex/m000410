<script>
export default {
  props: {
    urls: Object,
    configs: Object
  },
  data() {
    return {
      liveValues: {}
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
            this.liveValues = response.data.data;
          });
      }
    },
    getOptions: function (column, optionSet) {
      if (this.blank(optionSet)) {
        return [];
      }
      return this.array_get(optionSet, column + '.options', []);
    }
  }
}
</script>
