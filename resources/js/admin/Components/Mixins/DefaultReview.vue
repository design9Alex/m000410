<script>
export default {
  props: {
    urls: Object,
    configs: Object
  },
  data() {
    return {
      liveValues: {},
      originalData: {},
      modifiedData: {},
      modifiedColumns: {}
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
            this.originalData = response.data.data.original;
            this.modifiedData = response.data.data.modified;
            this.modifiedColumns = response.data.data.columns;
            this.setLiveValues('modified');
          });
      }
    },
    getOptions: function (column, optionSet) {
      if (this.blank(optionSet)) {
        return [];
      }
      return this.array_get(optionSet, column + '.options', []);
    },
    setLiveValues: function (type) {
      switch (type) {
        case 'original':
          this.liveValues = JSON.parse(JSON.stringify(this.originalData));
          break;
        case 'modified':
          let modifiedData = JSON.parse(JSON.stringify(this.originalData));
          for (let column in this.modifiedData) {
            modifiedData[column] = JSON.parse(JSON.stringify(this.modifiedData[column]));
          }
          this.liveValues = modifiedData;
      }
    }
  }
}
</script>
