
**1. Compare Attack Results Across All 3 Environments:**
```bash
# Vulnerable DVWA - Attack SUCCEEDS
curl "http://localhost/vulnerabilities/sqli/?id=1' OR '1'='1"
# Returns: All user records (CIA breach!)

# Secure DVWA - Attack FAILS
curl "http://localhost:8080/vulnerabilities/sqli/?id=1' OR '1'='1"
# Returns: No results (protected)

# WAF-Protected DVWA - Attack BLOCKED by WAF
curl "http://localhost:9000/vulnerabilities/sqli/?id=1' OR '1'='1"
# Returns: 403 Forbidden (WAF rule triggered)
```

**2. Test SQLi Payloads Against WAF:**
- Basic SQLi: `' OR '1'='1`, `admin' --`, `' UNION SELECT`
- Blind SQLi: `' AND SLEEP(5)`, `' OR SLEEP(5)`
- Time-based: `' AND IF(1=1, SLEEP(3), 0)`
- Keyword bypass: `sele ct`, `uni/**/on`
- Case variation: `UnIoN`, `SeLeCt`
- Comment bypass: `' /*! OR */ '1'='1`
- Null byte: `%00' OR '1'='1`

**3. Identify Bypasses:**
- Document which payloads successfully bypass WAF
- Test encoding: URL-encoding, double-encoding, unicode
- Burp suite
- Test obfuscation techniques
- Recommend improved rules

**4. Deliverable: WAF_ANALYSIS.md**
```
- Test matrix: payloads vs. 3 environments
- Detection rate: % of attacks blocked
- Bypass techniques discovered
- Performance impact (response time)
- Recommended rule improvements
- Screenshots of blocked/passed attacks


---

## Lab Setup

```bash
cd /sqli_lab
docker compose up -d
```

**Access Points:**
- Vulnerable DVWA: http://localhost
- Secure DVWA: http://localhost:8080
- WAF-Protected DVWA: http://localhost:9000
- Burp Suite: http://localhost:8081

All credentials: `admin/password`

---

| Week | Focus | Members task |
|------|-------|--------------|
| 1 | Vulnerability confirmation | Test WAF detection on basic attacks |
| 2 | Secure coding | Tune WAF rules, reduce false positives |
| 3 | Advanced analysis | Test advanced bypasses, compare all 3 environments |
| 4 | Reporting | Create unified defense report |

---

## Docker Compose Services

- `dvwa` (vulnerable): port 80
- `dvwa-secure` (parameterized): port 8080
- `dvwa-waf` (firewall-protected): port 9000
- `mysql-vuln`, `mysql-secure`, `mysql-waf`: databases
- `burpsuite`: port 8081

All containers on shared network: `sqli-lab`
