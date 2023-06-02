<script>
import CommonReview from "../Common/Review";
import MinmaxRoleOperationList from "../../Components/Form/Static/RoleOperationList";

export default {
  extends: CommonReview,
  name: "ArticleCategoryReview",
  components: {
    MinmaxRoleOperationList
  },
  computed: {
    previewed: function () {
      return this.filled(this.urls.preview) && this.filled(this.liveValues.parent_id);
    }
  }
}
</script>
