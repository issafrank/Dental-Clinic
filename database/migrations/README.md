# Migrations

The full schema lives in `database/schema.sql`. Import it once for fresh setups:

```bash
mysql -u root dental_clinic < database/schema.sql
```

If you prefer step-by-step migrations, split `schema.sql` into the
numbered files referenced in the project README and run them in order.
