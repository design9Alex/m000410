<script>
import CommonIndex from "../Common/Index";

export default {
  extends: CommonIndex,
  name: "SystemTrashIndex",
  methods: {
    doRestore: function (url) {
      if (this.blank(url)) {
        return;
      }

      this.$swal({
        title: this.array_get(this.trans, 'ui.message.restoring'),
        icon: 'info',
        showConfirmButton: false,
        allowOutsideClick: false
      });

      axios
        .post(url)
        .then((response) => {
          if (response.data.code === '0000') {
            this.baseIndex.renderGrid();
            this.$swal.close();
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
