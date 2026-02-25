const express = require("express");
const router = express.Router();
const PreOperative = require("../models/PreOperative");

// ==========================
// GET PAGE
// URL: /pre-operative
// ==========================
router.get("/", async (req, res) => {
  try {
    const rows = await PreOperative.find().sort({ _id: 1 });

    const totalResult = await PreOperative.aggregate([
      {
        $group: {
          _id: null,
          totalAmount: { $sum: "$approximate_cost_in_rupees" }
        }
      }
    ]);

    const totalAmount = totalResult.length > 0 ? totalResult[0].totalAmount : 0;

    res.render("pre_operative", {
      rows,
      totalAmount
    });

  } catch (error) {
    console.error(error);
    res.status(500).send("Server Error");
  }
});


// ==========================
// ADD
// URL: /pre-operative/add
// ==========================
router.post("/add", async (req, res) => {
  try {
    const { registration_and_licenses, issuing_authority, approximate_cost } = req.body;

    await PreOperative.create({
      registration_and_licenses,
      issuing_authority,
      approximate_cost_in_rupees: approximate_cost
    });

    res.redirect("/pre-operative");

  } catch (error) {
    console.error(error);
    res.status(500).send("Error Adding Record");
  }
});


// ==========================
// UPDATE
// URL: /pre-operative/update
// ==========================
router.post("/update", async (req, res) => {
  try {
    const { id, registration_and_licenses, issuing_authority, approximate_cost } = req.body;

    await PreOperative.findByIdAndUpdate(id, {
      registration_and_licenses,
      issuing_authority,
      approximate_cost_in_rupees: approximate_cost
    });

    res.redirect("/pre-operative");

  } catch (error) {
    console.error(error);
    res.status(500).send("Error Updating Record");
  }
});


// ==========================
// DELETE
// URL: /pre-operative/delete/:id
// ==========================
router.get("/delete/:id", async (req, res) => {
  try {
    await PreOperative.findByIdAndDelete(req.params.id);
    res.redirect("/pre-operative");

  } catch (error) {
    console.error(error);
    res.status(500).send("Error Deleting Record");
  }
});

module.exports = router;