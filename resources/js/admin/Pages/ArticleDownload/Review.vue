<script>
import CommonReview from "../Common/Review";
import MinmaxRelationList from "../../Components/Form/Static/RelationList";

export default {
  extends: CommonReview,
  name: "ArticleDownloadReview",
  components: {
    MinmaxRelationList
  },
  computed: {
    previewed: function () {
      return this.filled(this.urls.preview) && this.filled(this.liveValues.articleCategories);
    }
  }
}
</script>
