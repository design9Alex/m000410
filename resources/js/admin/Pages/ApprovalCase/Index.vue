<script>
import CommonIndex from "../Common/Index";
import SitePageBatch from "../../Components/PageApprovalCase/SitePageBatch";
import GridGates from "../../Components/PageApprovalCase/GridGates";

export default {
  extends: CommonIndex,
  name: "ApprovalCaseIndex",
  components: {
    SitePageBatch,
    GridGates
  },
  methods: {
    doPreview: function (params) {
      let previewData = JSON.parse(JSON.stringify(params.original_data));
      if (this.blank(previewData)) {
        previewData = {};
      }
      for (let column in params.modified_data) {
        previewData[column] = JSON.parse(JSON.stringify(params.modified_data[column]));
      }

      axios.post(params.url, {previewData: previewData})
        .then((response) => {
          if (response.data.code === '0000') {
            window.open(response.data.preview_url, 'pagePreview');
          } else {
            this.$swal({text: response.data.message, icon: 'error'});
          }
        })
        .catch((error) => {
          this.$swal({text: error.response.data.message, icon: 'error'});
        });
    }
  }
}
</script>
