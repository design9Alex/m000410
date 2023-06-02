<template>
  <section class="panel h-100-c">
    <div id="world-source-map"></div>
  </section>
</template>

<script>
import 'amcharts3';
import 'amcharts3/amcharts/themes/light';
import 'ammap3';
import 'ammap3/ammap/maps/js/worldLow';

export default {
  name: "WorldSource",
  props: {
    'urls': Object,
    'trans': Object,
    'days': {
      type: Number,
      default: 30
    }
  },
  data() {
    return {
      mapChart: null,
      mapSource: []
    }
  },
  mounted: function () {
    this.updateMapSource();
  },
  methods: {
    createAmMap: function () {
      this.mapChart = new AmCharts.AmMap();
      this.mapChart.addTitle(this.array_get(this.trans, 'module.source_country'), 14);
      this.mapChart.hideCredits = true;
      this.mapChart.projection = "winkel3";
      this.mapChart.areasSettings = {unlistedAreasColor: "#000000", unlistedAreasAlpha: 0.1};
      this.mapChart.imagesSettings = {
        balloonText: "<span style='font-size:14px;'><b>[[title]]</b>: [[value]]</span>",
        alpha: 0.6
      };
      this.mapChart.dataProvider = {mapVar: AmCharts.maps.worldLow, images: []};
      if (this.mapSource.length > 0) {
        for (let index in this.mapSource) {
          this.mapChart.dataProvider.images.push({
            type: "circle", width: 10, height: 10,
            color: this.mapSource[index].color,
            longitude: this.mapSource[index].longitude,
            latitude: this.mapSource[index].latitude,
            title: this.mapSource[index].name,
            value: this.mapSource[index].value
          });
        }
      }
      this.mapChart.write("world-source-map");
    },
    updateMapSource: function () {
      if (this.filled(this.urls.world_source)) {
        axios.get(this.urls.world_source + '?days=' + this.days)
          .then((response) => {
            this.mapSource = response.data;
            this.$nextTick(() => {
              this.createAmMap();
            });
          });
      }
    }
  }
}
</script>

<style scoped>
#world-source-map {
  width: 100%;
  height: 440px;
}
</style>
