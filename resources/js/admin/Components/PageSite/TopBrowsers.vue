<template>
  <section class="panel h-55-c">
    <header class="panel-heading text-center">
      <h2 class="h5 float-left">{{ array_get(trans, 'module.browser_usage') }}</h2>
    </header>
    <template v-for="(row, index) in browsers">
      <div class="clearfix px-4"
           :class="{'py-1': parseInt(index) !== 0, 'pb-2': parseInt(index) === browsers.length - 1}">
        <span class="flot-left small">{{ row.browser }}</span>
        <span class="float-right"><span :class="getBadgeClass(index)">{{ row.rate }}</span></span>
      </div>
      <hr class="my-2 w-100" v-if="parseInt(index) < (browsers.length - 1)" />
    </template>
  </section>
</template>

<script>
export default {
  name: "TopBrowsers",
  props: {
    'urls': Object,
    'trans': Object,
    'days': {
      type: Number,
      default: 30
    },
    'max': {
      type: Number,
      default: 4
    }
  },
  data() {
    return {
      browsers: []
    }
  },
  mounted: function () {
    this.updateData();
  },
  methods: {
    updateData: function () {
      if (this.filled(this.urls.top_browsers)) {
        axios.get(this.urls.top_browsers + '?days=' + this.days + '&max=' + this.max)
          .then((response) => {
            this.browsers = response.data;
          });
      }
    },
    getBadgeClass: function (index) {
      switch (parseInt(index)) {
        case 0:
          return ['badge', 'badge-pill', 'badge-main'];
        case 1:
          return ['badge', 'badge-pill', 'badge-warning'];
        case 2:
          return ['badge', 'badge-pill', 'badge-info'];
        case 3:
          return ['badge', 'badge-pill', 'badge-success'];
        default:
          return ['badge', 'badge-pill'];
      }
    }
  }
}
</script>
