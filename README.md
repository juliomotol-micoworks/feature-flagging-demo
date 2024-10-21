# Feature Flagging Demo

This demo consists 3 branches all implementing feature flagging but in different approaches.

- `pennant`
- `inhouse`
- `config`

You can toggle each feature by updating the following in `.env`

```env
FEATURE_FOO=<bool>
FEATURE_BAR=<bool>
FEATURE_BAZ=<bool>
```
