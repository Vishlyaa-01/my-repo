const mongoose = require("mongoose");

const preOperativeSchema = new mongoose.Schema({
  registration_and_licenses: String,
  issuing_authority: String,
  approximate_cost_in_rupees: Number
});

module.exports = mongoose.model("PreOperative", preOperativeSchema);