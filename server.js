const express = require("express");
const { createClient } = require("@supabase/supabase-js");
const cors = require("cors");
const bodyParser = require("body-parser");

const app = express();
const PORT = process.env.PORT || 3000;

app.use(cors());
app.use(bodyParser.json());

const supabaseUrl = "https://pjtwsysuigrifohiiinw.supabase.com";
const supabaseKey =
  "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InBqdHdzeXN1aWdyaWZvaGlpaW53Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzAyOTE0MjQsImV4cCI6MjA0NTg2NzQyNH0.O6IFG190FlRO-4U9dO3bME3iSr-xisRpe6g4hw5d4Bs";
const supabase = createClient(supabaseUrl, supabaseKey);

app.get("/api/products", async (req, res) => {
  const { data, error } = await supabase.from("products").select("*");

  if (error) return res.status(500).send(error);
  res.json(data);
});

app.post("/api/products", async (req, res) => {
  const { name, price, image } = req.body;

  const { data, error } = await supabase
    .from("products")
    .insert([{ name, price, image }]);

  if (error) return res.status(500).send(error);
  res.status(201).json(data);
});

app.put("/api/products/:id", async (req, res) => {
  const productId = req.params.id;
  const { name, price, image } = req.body;

  const { data, error } = await supabase
    .from("products")
    .update({ name, price, image })
    .match({ id: productId });

  if (error) return res.status(500).send(error);
  res.json(data);
});

app.delete("/api/products/:id", async (req, res) => {
  const productId = req.params.id;

  const { data, error } = await supabase
    .from("products")
    .delete()
    .match({ id: productId });

  if (error) return res.status(500).send(error);
  res.status(204).send();
});

app.listen(PORT, () => {
  console.log(`Server is running on http://localhost:${PORT}`);
});
