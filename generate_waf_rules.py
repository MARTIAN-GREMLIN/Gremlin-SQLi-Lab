
def generate_waf_rules(output_file="sqli-rules.conf"):
    """Generate ModSecurity WAF rules for SQL injection and POST blocking"""
    
    # Define rules: (id, pattern, message)
    sqli_rules = [
        ("1000", r"(?:union|select|insert|update|delete|drop)", "SQL keyword detected"),
        ("1001", r"(--|#|/\*|\*/)", "SQL comment detected"),
        ("1002", r"' OR '.*'=", "SQL OR condition detected"),
        ("1003", r"SLEEP\s*\(", "Time-based SQLi detected"),
        ("1004", r"UNION\s+SELECT", "UNION-based SQLi detected"),
        ("1005", r"'\s*(AND|OR)\s+1\s*=", "Boolean-based SQLi detected"),
    ]
    
    # POST method rule: (id, message)
    post_rule = ("2000", "POST method not allowed")
    
    # Generate the configuration file
    with open(output_file, "w") as f:
        f.write("# ModSecurity SQL Injection Rules\n\n")
        
        # Write SQL Injection Rules
        f.write("# ===== SQL INJECTION DETECTION =====\n\n")
        for rule_id, pattern, message in sqli_rules:
            f.write(f'SecRule ARGS "@rx {pattern}" \\\n')
            f.write(f'  "id:{rule_id},phase:2,deny,status:403,msg:\'{message}\'" \n\n')
        
        # Write POST Method Rule
        f.write("# ===== BLOCK POST METHOD =====\n\n")
        rule_id, message = post_rule
        f.write(f'SecRule REQUEST_METHOD "@rx POST" \\\n')
        f.write(f'  "id:{rule_id},phase:1,deny,status:405,msg:\'{message}\'" \n\n')
    
    print(f"✓ Successfully generated: {output_file}")
    print(f"Total rules created: {len(sqli_rules) + 1}")
    print(f"Move to waf folder: mv {output_file} waf/")
    
if __name__ == "__main__":
    generate_waf_rules()
