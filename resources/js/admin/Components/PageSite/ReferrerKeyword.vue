<template>
  <section class="panel h-100-c">
    <header class="panel-heading">
      <h2 class="h5 float-left">{{ array_get(trans, 'module.referrer_keyword') }}</h2>
    </header>
    <div class="panel-wrapper">
      <div class="panel-body">
        <div class="table-responsive-sm">
          <table class="table">
            <thead class="font-weight-bold">
            <tr>
              <th class="text-center w-3">#</th>
              <th>{{ array_get(trans, 'module.keyword') }}</th>
              <th class="text-right">{{ array_get(trans, 'module.keyword_count') }}</th>
            </tr>
            </thead>
            <tbody v-if="blank(keywords)" class="text-center">
            <tr>
              <td class="text-muted" colspan="3">{{ array_get(trans, 'module.keyword_empty') }}</td>
            </tr>
            </tbody>
            <tbody v-else>
            <tr v-for="(row, index) in keywords">
              <th class="text-center" scope="row">{{ index + 1 }}</th>
              <td class="text-break-word">{{ row.keyword }}</td>
              <td class="text-right">{{ row.count }}</td>
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
  name: "ReferrerKeyword",
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
      keywords: []
    }
  },
  mounted: function () {
    this.updateData();
  },
  methods: {
    updateData: function () {
      if (this.filled(this.urls.referrer_keyword)) {
        axios.get(this.urls.referrer_keyword + '?days=' + this.days + '&max=' + this.max)
          .then((response) => {
            this.keywords = response.data;
          });
      }
    }
  }
}
</script>
