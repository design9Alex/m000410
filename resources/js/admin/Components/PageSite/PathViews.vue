<template>
  <section class="panel h-100-c">
    <header class="panel-heading">
      <h2 class="h5 float-left">{{ array_get(trans, 'module.hot_page') }}</h2>
    </header>
    <div class="panel-wrapper">
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table">
            <thead class="font-weight-bold text-center">
            <tr>
              <th class="w-3">#</th>
              <th class="text-left w-50">{{ array_get(trans, 'module.path') }}</th>
              <th>{{ array_get(trans, 'module.path_view') }}</th>
              <th>{{ array_get(trans, 'module.path_time') }}</th>
            </tr>
            </thead>
            <tbody v-if="blank(pages)" class="text-center">
            <tr>
              <td class="text-muted" colspan="4">{{ array_get(trans, 'module.path_empty') }}</td>
            </tr>
            </tbody>
            <tbody v-else class="text-center">
            <tr v-for="(page, index) in pages">
              <th scope="row">{{ index + 1 }}</th>
              <td class="text-left text-break-word">
                <a class="text-primary" :href="page.url" target="_blank">{{ page.path }}</a>
              </td>
              <td>{{ page.count }}</td>
              <td>{{ page.time }}</td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "PathViews",
  props: {
    'urls': Object,
    'trans': Object,
    'days': {
      type: Number,
      default: 30
    },
    'max': {
      type: Number,
      default: 5
    }
  },
  data() {
    return {
      pages: []
    }
  },
  mounted: function () {
    this.updateData();
  },
  methods: {
    updateData: function () {
      if (this.filled(this.urls.path_views)) {
        axios.get(this.urls.path_views + '?days=' + this.days + '&max=' + this.max)
          .then((response) => {
            this.pages = response.data;
          });
      }
    }
  }
}
</script>
